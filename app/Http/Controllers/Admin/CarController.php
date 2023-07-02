<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CarStoreRequest;
use Auth;
use function serialize;

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
        $image = $request->file('image')->store('public/img');
        // Retrieve the selected checkboxes for the car description
        $description = $request->input('description', []);
        $owner_id = Auth::user()->id;
        // dd($owner_id);

        $carStore =  Car::create([
            // 'booking_no' => 'BC'.rand(1000,9999),
            'name' => $request->name,
            'owner_id' => $owner_id,
            'model' => $request->model,
            'brand' => $request->brand,
            'car_plate' => $request->car_plate,
            'year_register' => $request->year_register,
            'location' => $request->location,
            'car_status' => $request->car_status,
            'charge_per_hour' => $request->charge_per_hour,
            'charge_per_day' => $request->charge_per_day,
            'image' => $image,
            'description' => json_encode($description),
        ]);

        
        // $carStore->owner_id = $owner_id;
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
            if (!is_null($image)){
            Storage::delete($cars->image);
            }
            $image = $request->file('image')->store('public/img');
        }
  
        $description = $request->input('description', []);
        // dd($description);

        $cars->update([
            'name' => $request->name,
            // 'owner_id' => $request
            'model' => $request->model,
            'brand' => $request->brand,
            'car_plate' => $request->car_plate,
            'year_register' => $request->year_register,
            'location' => $request->location,
            'car_status' => $request->car_status,
            'charge_per_hour' => $request->charge_per_hour,
            'charge_per_day' => $request->charge_per_day,
            'image' => $image,
            'description' => json_encode($description),

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


