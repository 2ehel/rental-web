<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationStoreRequest;
use Auth;

class CarController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        if (Auth::user()->category == 'Renter'){
        $cars = Car::where('owner_id', $userid)->get();
        } else {
        $cars = Car::all();
        }
        return view('admin.cars.index', compact('cars'));
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
    public function store(ReservationStoreRequest $request)
    {

        // dd($request);
        Booking::create([
            'booking_no' => 'BC'.rand(1000,9999),
            'customer_name' => $request->customer_name,
            'customer_id' => $request->cust_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'booking_status' => $request->booking_status,
            'total_pay' => $request->total_pay,
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
    public function edit(Booking $bookings)
    {
        // $tables = Table::where('status', TableStatus::Avalaiable)->get();
        return view('admin.reservations.edit', compact('reservation', 'tables'));
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
        return to_route('admin.reservations.index')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return to_route('admin.reservations.index')->with('warning', 'Reservation deleted successfully.');
    }
}


