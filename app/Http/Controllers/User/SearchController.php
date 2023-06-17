<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use App\Models\History;
use App\Models\Invoice;
use Auth;
use Arr;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function index()
    {   
        $car_list = Car::all();
        return view('layouts.search_car',compact('car_list'));
    }

    public function search(Request $request)
    {
        // dd($request->input('start_date'));
        $startDate = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('start_date'));
        $category = $request->input('category');
    
        // Perform your search logic here
        // Check if the provided start_date falls within the range of existing bookings
        $existingBookings = Booking::where('start_date', '<=', $startDate)
            ->where('end_date', '>=', $startDate)
            ->get();
    
        // Retrieve the cars that are not involved in any existing bookings
        $availableCars = Car::whereNotIn('id', $existingBookings->pluck('car_id')->toArray())
            // ->where('category', $category)
            ->get();
        
            return view('layouts.car_listing',compact('availableCars'));
    }
}
