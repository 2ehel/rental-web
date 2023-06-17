<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
use App\Models\User;
use App\Models\Invoice;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['booking_no','customer_name','customer_id','car_id','car_owner_id','start_date','end_date','duration' ,'duration_option','booking_status','total_pay','invoice_no','created_by', 'updated_by','history_no'];
    protected $dates = ['start_date'];

    public function car_book()
    {
        // return $this->belongsTo(Car::class);
        return $this->hasOne(Car::class, 'id', 'car_id');
    }

    public function cust_book()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    public function book_invoice()
    {
        return $this->hasOne(Invoice::class, 'invoice_no', 'invoice_no');
    }

    public function book_history()
    {
        return $this->hasOne(History::class, 'history_no', 'history_no');
    }
}




