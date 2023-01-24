<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Booking;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Booking::class;
    
    public function definition()
    {
            $year = rand(2022, 2021);
            $month = rand(1, 12);
            $day = rand(1, 28);
            $date = Carbon::create($year,$month ,$day , 0, 0, 0);
        return [
            'booking_no' => rand(1000,9999),
            'customer_name' => $this->faker->name(),
            'customer_id' => rand(1000,9999),
            'car_id' => rand(1000,9999),
            'booking_status' => 'Success',
            'start_date' => $date->format('Y-m-d H:i'),
            // 'year_register' => rand(1980,2030),
            'total_pay' => rand(5,100)
        ];
    }
}
