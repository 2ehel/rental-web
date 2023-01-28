<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            // 'id' => 12
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'category' => 'Admin',
            'password' => Hash::make('secret'), // password
            'remember_token' => Str::random(10),
            'is_admin' => 1
        ]);

        User::create([
            'id' => 13,
            'name' => 'Nuratia Afifah',
            'email' => 'atia@gmail.com',
            'email_verified_at' => now(),
            'category' => 'Renter',
            'password' => Hash::make('rahsia'), // password
            'remember_token' => Str::random(10),
            'is_admin' => 1
        ]);

        User::create([
            'id' => 14,
            'name' => 'Aina Syuhadah',
            'email' => 'aina@gmail.com',
            'email_verified_at' => now(),
            'category' => 'Rentee',
            'password' => Hash::make('rahsia'), // password
            'remember_token' => Str::random(10),
            'is_admin' => 0
        ]);

        User::create([
            'id' => 15,
            'name' => 'FendyMojo',
            'email' => 'fendymojo@gmail.com',
            'email_verified_at' => now(),
            'category' => 'Rentee',
            'password' => Hash::make('rahsia'), // password
            'remember_token' => Str::random(10),
            'is_admin' => 0
        ]);

    }
}
