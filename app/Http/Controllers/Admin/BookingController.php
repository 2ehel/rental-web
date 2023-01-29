<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationStoreRequest;
use Auth;


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
        // dd($this->hour_duration);
        return view('admin.bookings.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request)
    {
        $car = Car::findOrFail($request->car_id);
        if($request->duration_option == 'days'){
            $this->calc_duration = $request->duration*$car->charge_per_day;
        } else {
            $this->calc_duration = $request->duration*$car->charge_per_hour;
        } 
// dd($request);
        Booking::create([
            'booking_no' => 'BC'.rand(1000,9999),
            'customer_name' => $request->first_name." ".$request->last_name,
            'customer_id' => $request->cust_id,
            'car_id' => $request->car_id,
            'car_owner_id' => $car->owner_id,
            'start_date' => $request->start_date,
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

    public function update(Request $request, Booking $booking)
    {

        $car = Car::findOrFail($request->car_id);
        
        // dd($car);

        if($request->duration_option == 'days'){
            $this->calc_duration = $request->duration*$car->charge_per_day;
        } elseif ($request->duration_option == 'hours') {
            $this->calc_duration = $request->duration*$car->charge_per_hour ;
        } 

        $booking->update([
            'customer_name' => $request->customer_name,
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'booking_status' => $request->booking_status,
            'duration_option' => $request->duration_option,
            'total_pay' => $this->calc_duration,
        ]);


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

    public function updateStatus(Request $request, Booking $booking)
    {   
        DB::table('bookings')->where('id', $request->id )->update([
            'booking_status' => $request->booking_status,
        ]);
        // dd($booking);
        return to_route('admin.bookings.index');
    }

    
}
