<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
use Stripe;

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

            'customer_id' => ['required'],
            'duration_option' => ['required'],
            'duration' => ['required'],
            'start_date' => ['required'],
            'start_time' => ['required'],
            'booking_status' => ['required'],
            'total_pay' => ['required'],
        ]);
        // Convert the start time to a Carbon instance
        $startDate = Carbon::createFromFormat('Y-m-d H:i', $request->input('start_date') . ' ' . $request->input('start_time'));
            $bookings = new Booking();
            $bookings->fill([
            'customer_id' => $validated['customer_id'],
            'start_date' => $startDate,
            // 'start_time' => $startDate,
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
        $bookings = $request->session()->get('bookings');
        // dd($bookings);
        
        $startDate = $bookings->start_date;
        // Add the duration (days and hours) to the start time to calculate the end time
        if ($bookings->duration_option == 'days'){ 
            $endDate = $startDate->copy()->addDays($bookings->duration);
        } elseif ($bookings->duration_option == 'hours') {
        $endDate = $startDate->copy()->addHours($bookings->duration);
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

        $validated = $request->validate([
            'car_id' => ['required']
        ]);
        
        $car_no = $validated['car_id'];
        $car = Car::findOrFail($car_no);

        if($bookings->duration_option == 'days'){
            $this->calc_duration = $bookings->duration*$car->charge_per_day;
        } else {
            $this->calc_duration = $bookings->duration*$car->charge_per_hour;
        } 
        
        $bookings = Booking::create([
            'booking_no' => 'BC'.rand(1000,9999),
            'customer_name' => Auth::user()->name,
            'customer_id' => $bookings->customer_id,
            'start_date' => $bookings->start_date,
            'duration' => $bookings->duration,
            'end_date' => $endDate,
            // 'booking_status' => $bookings->booking_status,
            'duration_option' => $bookings->duration_option,
            'total_pay' => $this->calc_duration,
            'car_id' => $car_no,
            'booking_status' => 'Pending',
            'car_owner_id' => $car->owner_id,

        ]); 
        $bookings->save();
        $request->session()->put('bookings', $bookings);

        return to_route('bookings.payment');
        // return to_route('thankyou');
    }

    public function payment(Request $request)
    {
        $bookings = $request->session()->get('bookings');
        return view('bookings.payment',compact('bookings'));
    }

    public function storePayment(Request $request)
    {
        $booking_no = $request->input('booking_no');
        $action = $request->input('action');

        if ($action === 'cancel') {
            Booking::where('booking_no', $booking_no)->delete();
            return redirect()->route('bookings.step.two');

        } elseif ($action === 'proceed') {
            // $booking =  Booking::where('booking_no', $booking_no)->get();
            // $request->session()->put('booking', $booking);
            return redirect()->route('bookings.checkout');
        }

        // return to_route('bookings.step.two');
    }

    public function checkout(Request $request)
    {
        $booking = $request->session()->get('booking');
        return view('bookings.stripe',compact('booking'));
    }
 
    public function session(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

  

        $customer = Stripe\Customer::create(array(
    
                "address" => [
    
                        "line1" => "Virani Chowk",
    
                        "postal_code" => "360001",
    
                        "city" => "Rajkot",
    
                        "state" => "GJ",
    
                        "country" => "IN",
    
                    ],
    
                "email" => "demo@gmail.com",
    
                "name" => "Hardik Savani",
    
                "source" => $request->stripeToken
    
             ));
    
      
    
        Stripe\Charge::create ([
    
                "amount" => 100 * 100,
    
                "currency" => "usd",
    
                "customer" => $customer->id,
    
                "description" => "Test payment from itsolutionstuff.com.",
    
                "shipping" => [
    
                  "name" => "Jenny Rosen",
    
                  "address" => [
    
                    "line1" => "510 Townsend St",
    
                    "postal_code" => "98140",
    
                    "city" => "San Francisco",
    
                    "state" => "CA",
    
                    "country" => "US",
    
                  ],
    
                ]
    
        ]); 
    
        Session::flash('success', 'Payment successful!');
    
        return back();
    }
    public function success()
    {
        return "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible";
    }

    public function updateStatus(Request $request, $booking_id)
    {   
        dd($request);

        DB::table('bookings')->where('id', $booking_id)->update([
            'booking_status' => $request->booking_status,
        ]);
        if(Auth::user()->category == 'Rentee')
        {        return to_route('bookings.index');

        } else 
        {        return to_route('bookings.index');


        }
    }

}

    

