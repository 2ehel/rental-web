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
use DB;

class BookingController extends Controller
{
    // public  $booking_id, $customer_name, $car_id, $start_date, $end_date, $booking_status, $total_pay, $created_at, $created_by, $updated_by;
    
    public function listing()
    {
        $user_id = Auth::user()->id;
        $bookings =  Booking::where('customer_id', $user_id)->get();
        // dd($bookings);
        return view('bookings.index', compact(['bookings']));
    }

    public function stepOne(Request $request)
    {
        $booking = $request->session()->get('booking');

        return view('bookings.step-one', compact('booking'));
    }

    public function storeStepOne(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'customer_id' => ['required'],
            'duration_option' => ['required'],
            'duration' => ['required'],
            'start_date' => ['required', 'date', new DateBetween],
            'booking_status' => ['required'],
            'total_pay' => ['required'],
        ]);
            $bookings = new Booking();
            $bookings->fill([
            'customer_name' => $validated['first_name']." ".$validated['last_name'],
            'customer_id' => $validated['customer_id'],
            'start_date' => $validated['start_date'],
            'duration_option' => $validated['duration_option'],
            'duration' => $validated['duration'],
            'booking_status' => $validated['booking_status'],
            ]);

            $request->session()->put('bookings', $bookings);
        

        return to_route('bookings.step.two');
    }

    public function stepTwo(Request $request)
    {
        $bookings = $request->session()->get('bookings');

        $cars = Car::all();

        return view('bookings.step-two', compact('bookings', 'cars'));
    }

    public function storeStepTwo(Request $request)
    {
        $validated = $request->validate([
            'car_id' => ['required']
        ]);
        $bookings = $request->session()->get('bookings');
        $car_no = $validated['car_id'];
        $car = Car::findOrFail($car_no);
        // dd($car);

        if($bookings->duration_option == 'days'){
            $this->calc_duration = $bookings->duration*$car->charge_per_day;
        } else {
            $this->calc_duration = $bookings->duration*$car->charge_per_hour;
        } 
        $bookings = Booking::create([
            'booking_no' => 'BC'.rand(1000,9999),
            'customer_name' => $bookings->customer_name,
            'customer_id' => $bookings->customer_id,
            'start_date' => $bookings->start_date,
            'duration' => $bookings->duration,
            // 'booking_status' => $bookings->booking_status,
            'duration_option' => $bookings->duration_option,
            'total_pay' => $this->calc_duration,
            'car_id' => $car_no,
            'booking_status' => 'Pending',
            'car_owner_id' => $car->owner_id,

        ]); 
        $bookings->save();
        $request->session()->forget('bookings');

        return to_route('thankyou');
    }
    public function updateStatus(Request $request, Booking $booking)
    {   
        DB::table('bookings')->where('id', $request->id )->update([
            'booking_status' => $request->booking_status,
        ]);
        // dd($request);
        if(Auth::user()->category == 'Rentee')
        {        return to_route('bookings.index');

        } else 
        {        return to_route('admin.bookings.index');


        }
    }

}

    

