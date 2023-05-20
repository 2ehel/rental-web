<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

// use App\Models\ExtendedModel;


class Car extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['name','model','brand','car_plate','year_register','charge_per_hour','charge_per_day','image','created_by', 'updated_by'];

    public function car_book()
    {
        return $this->hasMany(Booking::class);
    }
}
