<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Car;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * 
     * @return array<string, mixed>
     */
    protected $model = Car::class;


    public function definition()
    {
        // $faker = Faker\Factory::create();
        $brand_car = ['Perodua','Proton','BMW','Volkswagon','Toyota'];
        $model_car = ['Alza','Axia','Myvi','Vios','Rush','X50'];

        return [
            'name' => $this->faker->name(),
            'brand' => Arr::random($brand_car),
            'car_plate' => 'JUS '. rand(1000,9999),
            'model' => Arr::random($model_car),
            'year_register' => rand(1980,2030),
            'charge_per_hour' => rand(5,8),
            'charge_per_day' => rand(60,100)
        ];
    }
}
