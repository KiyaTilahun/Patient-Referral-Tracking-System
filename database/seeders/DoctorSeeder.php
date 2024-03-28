<?php

namespace Database\Seeders;

use App\Models\Users\Doctor;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();
        $numberOfDoctors = 10;

        for ($i = 0; $i < $numberOfDoctors; $i++) {
            Doctor::create([
                'name' => $faker->unique()->name,
                'email' => $faker->unique()->email,
                'status' => rand(0, 1), // Random status
                'department_id' => rand(1, 5), // Assuming you have 5 departments
                'hospital_id' => rand(1, 10), // Assuming you have 10 hospitals
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
