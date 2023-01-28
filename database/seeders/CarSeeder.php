<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Car;
use Carbon\Carbon;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        // $car = Car::factory()->count(5)->create();

        Car::create([
            'name' => 'Nuratia Afifah',
            'owner_id' =>13,
            'brand' => 'Perodua',
            'car_plate' => 'JUS '. rand(1000,9999),
            'model' => 'Axia',
            'year_register' => rand(1980,2030),
            'charge_per_hour' => rand(5,8),
            'charge_per_day' => rand(60,100)
        ]);

        Car::create([
            'name' => 'Nuratia Afifah',
            'owner_id' =>13,
            'brand' => 'Perodua',
            'car_plate' => 'JUS '. rand(1000,9999),
            'model' => 'Alza',
            'year_register' => rand(1980,2030),
            'charge_per_hour' => rand(5,8),
            'charge_per_day' => rand(60,100)
        ]);

        Car::create([
            'name' => 'Aina Syuhadah',
            'owner_id' =>14,
            'brand' => 'Perodua',
            'car_plate' => 'JUS '. rand(1000,9999),
            'model' => 'Myvi',
            'year_register' => rand(1980,2030),
            'charge_per_hour' => rand(5,8),
            'charge_per_day' => rand(60,100)
        ]);

        Car::create([
            'name' => 'Admin',
            'owner_id' =>1,
            'brand' => 'Kia',
            'car_plate' => 'JUS '. rand(1000,9999),
            'model' => 'Karnival',
            'year_register' => rand(1980,2030),
            'charge_per_hour' => rand(5,8),
            'charge_per_day' => rand(60,100)
        ]);

        Car::create([
            'name' => 'FendyMojo',
            'owner_id' =>15,
            'brand' => 'Perodua',
            'car_plate' => 'JUS '. rand(1000,9999),
            'model' => 'Bezza',
            'year_register' => rand(1980,2030),
            'charge_per_hour' => rand(5,8),
            'charge_per_day' => rand(60,100)
        ]);

        // Car::create([
        //     'name' => 'Nuratia',
        //     'brand' => 'Perodua',
        //     'car_plate' => 'JUS '. rand(1000,9999),
        //     'model' => 'Axia',
        //     'year_register' => rand(1980,2030),
        //     'charge_per_hour' => rand(5,8),
        //     'charge_per_day' => rand(60,100)
        // ]);
    }
}
