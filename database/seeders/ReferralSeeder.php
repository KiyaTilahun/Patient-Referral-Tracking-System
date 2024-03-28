<?php

namespace Database\Seeders;

use App\Models\Referral\Referral;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $numberOfReferrals = 10;

        // Loop through and create dummy data for referrals
        for ($i = 0; $i < $numberOfReferrals; $i++) {
            Referral::create([
                'referring_hospital_id' => rand(1, 5), // Assuming you have 5 hospitals
                'receiving_hospital_id' => rand(6, 10), // Assuming you have 5 hospitals
                'referral_date' => now()->subDays(rand(1, 30)), // Random referral date within the last 30 days
                'reason' => 'Reason for referral ' . ($i + 1),
                'notes' => 'Additional notes for referral ' . ($i + 1),
                'appointment' => now()->addDays(rand(1, 30)), // Random appointment date within the next 30 days
                'file_path' => '/path/to/file' . ($i + 1), // Assuming file path for each referral
                'department_id' => rand(1, 5), // Assuming you have 5 departments
                'patient_id' => rand(1, 20), // Assuming you have 20 patients
                'doctor_id' => rand(1, 10), // Assuming you have 10 doctors
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
