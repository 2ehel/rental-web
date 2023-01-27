<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;

class BookingController extends Controller
{
    // public  $booking_id, $customer_name, $car_id, $start_date, $end_date, $booking_status, $total_pay, $created_at, $created_by, $updated_by;
    
    public function listing()
    {
        $user_id = Auth::user()->id;
        $bookings =  Booking::where('customer_id', $user_id)->get();

        return view('bookings.index', compact(['bookings']));
    }

    public function stepOne(Request $request)
    {
        $booking = $request->session()->get('booking');
        // $min_date = Carbon::today();
        // $max_date = Carbon::now()->addWeek();
        return view('bookings.step-one', compact('booking'));
    }

    public function storeStepOne(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'cust_id' => ['required'],
            'option_duration' => ['required'],
            'duration' => ['required'],
            'start_date' => ['required', 'date', new DateBetween],
            'booking_status' => ['required'],
            'total_pay' => ['required'],
        ]);

        if (empty($request->session()->get('bookings'))) {
            $bookings = new Booking();
            $bookings->fill($validated);
            $request->session()->put('bookings', $bookings);
        } else {
            $bookings = $request->session()->get('bookings');
            $bookings->fill($validated);
            $request->session()->put('bookings', $bookings);
        }
        // dd('Kamben');

        return redirect()->route('bookings.step.two');
    }

    public function stepTwo(Request $request)
    {
        $bookings = $request->session()->get('bookings');

        $cars = Car::findOrFail($request->car_id);

        return view('bookings.step-two', compact('bookings', 'cars'));
    }

    public function storeStepTwo(Request $request)
    {
        $validated = $request->validate([
            'car_id' => ['required']
        ]);
        $bookings = $request->session()->get('bookings');
        $bookings->fill($validated);
        $bookings->save();
        $request->session()->forget('bookings');

        return to_route('thankyou');
    }
}

    

