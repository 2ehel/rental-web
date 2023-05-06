<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History; 
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationStoreRequest;
use Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        
        // if (Auth::user()->category == 'Renter'){
        $history = History::all();
        // } else {
        // $history = Booking::with('car_book')->get();
        // }

        return view('admin.history.index', compact('history'));
    }
}
