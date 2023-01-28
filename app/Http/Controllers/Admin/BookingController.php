<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationStoreRequest;



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
        $bookings = Booking::with('car_book')->get();
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
        if($request->option_duration == 'days'){
            $this->calc_duration = $request->duration*24;
        } else {
            $this->calc_duration = $request->duration;
        } 

        Booking::create([
            'booking_no' => 'BC'.rand(1000,9999),
            'customer_name' => $request->first_name." ".$request->last_name,
            'customer_id' => $request->cust_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'booking_status' => $request->booking_status,
            'duration_option' => $request->duration_option,
            'total_pay' => $this->calc_duration*$car->charge,
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
        $cars = Car::findOrFail($booking->car_id);
        return view('admin.bookings.edit', compact('booking','cars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationStoreRequest $request, Booking $booking)
    {
        // $car = Car::findOrFail($request->car_id);
        // if ($request->car > $table->guest_number) {
        //     return back()->with('warning', 'Please choose the table base on guests.');
        // }
        $request_date = Carbon::parse($request->start_date);
        $reservations = $table->reservations()->where('id', '!=', $reservation->id)->get();
        // foreach ($reservations as $res) {
        //     if ($res->res_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
        //         return back()->with('warning', 'This table is reserved for this date.');
        //     }
        // }

        $reservation->update($request->validated());
        return to_route('admin.bookings.index')->with('success', 'Reservation updated successfully.');
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

        return to_route('admin.reservations.index')->with('warning', 'Reservation deleted successfully.');
    }
}
