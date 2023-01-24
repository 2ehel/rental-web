<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // public  $booking_id, $customer_name, $car_id, $start_date, $end_date, $booking_status, $total_pay, $created_at, $created_by, $updated_by;
    
    public function listing()
    {
        $user_id = Auth::user()->id;
        $bookings =  Booking::where('customer_id', $user_id)->get();

        return view('bookings.index', compact(['bookings']));
    }

    
}
