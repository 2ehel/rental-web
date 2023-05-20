<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CarStoreRequest;
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
        // $cars = Car::all();
        // dd($cars);
        return view('admin.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarStoreRequest $request)
    {
        // dd($request);
        $image = $request->file('image')->store('public/img');
        $carStore =  Car::create([
            // 'booking_no' => 'BC'.rand(1000,9999),
            'name' => $request->name,
            // 'owner_id' => $request
            'model' => $request->model,
            'brand' => $request->brand,
            'car_plate' => $request->car_plate,
            'year_register' => $request->year_register,
            'charge_per_hour' => $request->charge_per_hour,
            'charge_per_day' => $request->charge_per_day,
            'image' => $image,
        ]);
        $owner_id = $carStore->id;
        $carStore->owner_id = $owner_id;
        $carStore->save();

        return to_route('admin.cars.index')->with('success', 'Car added successfully.');
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
    public function edit($id)
    {   
        $cars = Car::find($id);
        return view('admin.cars.edit',compact('cars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $cars = Car::find($id);
        $image = $cars->image;
        if ($request->hasFile('image')) {
            Storage::delete($cars->image);
            $image = $request->file('image')->store('public/img');
        }

        $cars->update([
            'name' => $request->name,
            // 'owner_id' => $request
            'model' => $request->model,
            'brand' => $request->brand,
            'car_plate' => $request->car_plate,
            'year_register' => $request->year_register,
            'charge_per_hour' => $request->charge_per_hour,
            'charge_per_day' => $request->charge_per_day,
            'image' => $image,
        ]);

        return to_route('admin.cars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Car::find($id)->delete();
        return to_route('admin.cars.index')->with('warning', 'Car deleted successfully.');
    }
}


