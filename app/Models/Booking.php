<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
use App\Models\User;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['booking_no','customer_name','customer_id','car_id','start_date','end_date','booking_status','total_pay','created_by', 'updated_by'];

    public function car_book()
    {
        return $this->hasOne(Car::class, 'id', 'car_id');
    }

    public function cust_book()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }
}




