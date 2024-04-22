<?php

namespace Database\Seeders;

use App\Models\Admin\Hospital;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;


class SuperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); 
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // Replace 'your_password_here' with the desired password
            // Assuming you have a column named 'role' to store user roles
            'remember_token' => Str::random(10),
        ])->assignRole('superadmin');
        User::create([
            'name' => 'Kiya Tilahun',
            'email' => 'kiya@gmail.com',
            'email_verified_at' => now(),
            'hospital_id' => 1,
            'password' => Hash::make('12345678'), // Replace 'your_password_here' with the desired password
            // Assuming you have a column named 'role' to store user roles
            'remember_token' => Str::random(10),
        ])->assignRole('staff');

        User::create([
            'name' => 'Kiya Tilahun',
            'email' => 'kebe@gmail.com',
            'email_verified_at' => now(),
            'hospital_id' => 2,
            'password' => Hash::make('12345678'), // Replace 'your_password_here' with the desired password
            // Assuming you have a column named 'role' to store user roles
            'remember_token' => Str::random(10),
        ])->assignRole('doctor');

        $hospitalCount = Hospital::count(); // Get the number of hospitals

        for ($i = 1; $i <= $hospitalCount; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'hospital_id' => $i,
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
            ])->assignRole('admin');
        }
    }
}
