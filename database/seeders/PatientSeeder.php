<?php

namespace Database\Seeders;

use App\Models\Users\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $departments = [
            'Internal Medicine',
            'General Surgery',
            'Pediatrics',
            'Neonatology',
            'Gynecology',
            'Obstetrics',
            'Orthopedics',
            'Intensive Care Unit (ICU)',
            'Ophthalmology',
            'Dentistry',
            'Otorhinolaryngology (ENT)',
            'Psychiatry',
            'Plastic Surgery',
            'Burn Unit',
            'Urology',
            'Physiotherapy',
            'Dermatology',
            'Neurology',
            'Private Wing',
        ];

        $faker=Faker::create();

        $numberOfPatients = 20;

        // Loop through and create dummy data for patients
        for ($i = 0; $i < $numberOfPatients; $i++) {
            Patient::create([
                'name' => $faker->unique()->name(),
                'gender_id' => rand(1, 2),
                'bloodtype_id' => rand(1, 8), // Assuming 0 for male and 1 for female
                 // Assuming 0 for male and 1 for female
                'dob' => now()->subYears(rand(18, 70)), // Random date of birth between 18 and 70 years ago
                'card_number' => 'CARD' . $faker->phoneNumber(), // Unique card number for each patient
                // 'treatment' => array_rand($departments),
                // 'medical_history' => 'Medical history for patient ' . ($i + 1),
                'email' =>$faker->unique()->email() ,
                'phone' => $faker->unique()->phoneNumber(), // Assuming a dummy phone number
                'hospital_id' => rand(1, 5), // Assuming you have 5 hospitals
                // 'doctor_id' => rand(1, 10), // Assuming you have 10 doctors
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
