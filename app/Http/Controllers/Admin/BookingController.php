<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\History;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Requests\BookingStoreRequest;
use Auth;
use Arr;
use Carbon\Carbon;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $calc_duration;

    public function index()
    {
        $userid = Auth::user()->id;
        
        if (Auth::user()->category == 'Renter'){
        $bookings = Booking::where('car_owner_id',$userid)->with('car_book')->get();
        } else {
        $bookings = Booking::with('car_book')->get();
        }

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars = Car::all();
        // dd($cars);
        return view('admin.bookings.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingStoreRequest $request)
    {
        $car = Car::findOrFail($request->car_id);
        
        // Convert the start time to a Carbon instance
        $startDate = Carbon::createFromFormat('Y-m-d H:i', $request->input('start_date') . ' ' . $request->input('start_time'));

        // Add the duration (days and hours) to the start time to calculate the end time
        if ($request->duration_option == 'days'){ 
            $endDate = $startDate->copy()->addDays($request->duration);
        } elseif ($request->duration_option == 'hours') {
        $endDate = $startDate->copy()->addHours($request->duration);
        }
        
        // Check if there are any overlapping bookings for the same car
        $overlappingBookings = Booking::where('car_id', $request->car_id)
        ->where(function ($query) use ($startDate, $endDate) {
        $query->where(function ($q) use ($startDate, $endDate) {
            $q->where('start_date', '<=', $endDate)
                ->where('end_date', '>=', $startDate);
        });
        })
        ->get();

        if ($overlappingBookings->isNotEmpty()) {
        // Handle booking conflict, inform the customer and suggest an alternative
        return redirect()->back()->with('error', 'The car is not available during the requested time. Please choose a different time or car.');}
            
        // You can format the end time as needed
        $formattedEndTime = $endDate->format('Y-m-d H:i:s');

        if($request->duration_option == 'days'){
            $this->calc_duration = $request->duration*$car->charge_per_day;
        } else {
            $this->calc_duration = $request->duration*$car->charge_per_hour;
        } 
        Booking::create([
            'booking_no' => 'BC'.rand(1000,9999),
            'customer_name' => $request->first_name." ".$request->last_name,
            'customer_id' => $request->cust_id,
            'car_id' => $request->car_id,
            'car_owner_id' => $car->owner_id,
            'start_date' => $request->start_date,
            'end_date' => $endDate,
            'duration' => $request->duration,
            'booking_status' => $request->booking_status,
            'duration_option' => $request->duration_option,
            'total_pay' => $this->calc_duration,
        ]);

        return to_route('admin.bookings.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        $cars = Car::find($booking->car_id) || NULL;
        return view('admin.bookings.edit', compact('booking','cars'));
    }

    public function update(Request $request, $id)
    {
    
        // $car_id = intVal($request->car_id);
        $car = Car::where('id', $request->car_id)->first();
        if($request->duration_option == 'days'){
            $this->calc_duration = $request->duration*$car->charge_per_day;
        } elseif ($request->duration_option == 'hours') {
            $this->calc_duration = $request->duration*$car->charge_per_hour ;
        } 

        $booking = Booking::where('id',$id)->first();
        $booking->update([
            'customer_name' => $request->customer_name,
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'booking_status' => $request->booking_status,
            'duration_option' => $request->duration_option,
            'total_pay' => $this->calc_duration,
        ]);


        // dd($booking->booking_status == 'Release' && empty(History::find($booking->booking_no)));

        if ($booking->booking_status == 'Payment Received' && empty($booking->invoice_no))
        {
            $createdAt = Carbon::parse($booking->created_at); // Parse the created_at date as a Carbon instance
            $titleDate = $createdAt->format('dmY'); 

            $invoice = Invoice::create([
                'invoice_no' => 'IV' .rand(1000,9999),
                'booking_id' => $booking->booking_no,
                'history_id' => null,
                'invoice_details' => json_encode(['null' => null ]),
            ]);

            $booking ->update([
                'invoice_no' => $invoice->invoice_no, 
            ]);

            $invoice ->update([
                'invoice_details' => $invoice->invoice_no.$titleDate,
                                                // 'Booking ' => null,

            ]);
            
        }

        if ($booking->booking_status == 'Release' && empty($booking->history_no))
        {
            $createdAt = Carbon::parse($booking->created_at); // Parse the created_at date as a Carbon instance
            $titleDate = $createdAt->format('dmY'); 

            
            $history = History::create([
            'history_no' => "HT".rand(1000,9999),
            'title' => $booking->booking_no.$titleDate,
            'status' => "Success",
            'description' => null,
            'booking_no' => $booking->booking_no,
            'invoice_no' => $booking->invoice_no,
            ]);

            $booking ->update([
                'history_no' => $history->history_no, 
            ]);
        }

        // $booking->update($request->validated());
        return to_route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return to_route('admin.bookings.index')->with('warning', 'Booking deleted successfully.');
    }



    
}
