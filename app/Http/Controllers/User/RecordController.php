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

class RecordController extends Controller
{
    public function index($record)
    {
        $userid = Auth::user()->id;
        $bookings = Booking::where('customer_id',$userid);

        $listing = $bookings->when($record == 'invoice', function ($query) {
            return $query->with('book_invoice');
        })->when($record == 'history', function ($query) {
            return $query->with('book_history');
        })->get();

        // dd($listing);
        
        return view('records.listing_record', compact('listing','record'));
    }
}
