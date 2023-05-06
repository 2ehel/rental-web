<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History; 
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationStoreRequest;
use Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        
        $invoice = Invoice::all();

        return view('admin.invoice.index', compact('invoice'));
    }
}
