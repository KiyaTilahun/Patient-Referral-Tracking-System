<?php

namespace Database\Seeders;

use App\Models\Referral\Referral;
use App\Models\Users\Patient;
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
        $cardNumbers = Patient::pluck('card_number')->toArray();
        // Loop through and create dummy data for referrals
        for ($i = 0; $i < $numberOfReferrals; $i++) {
            $cardNumber = $cardNumbers[array_rand($cardNumbers)];
            Referral::create([
                'referring_hospital_id' => rand(1, 5), // Assuming you have 5 hospitals
                'receiving_hospital_id' => rand(6, 10), // Assuming you have 5 hospitals
                'referral_date' => now()->subDays(rand(1, 30)), // Random referral date within the last 30 days
                'referrtype_id' => rand(1, 3), // Assuming you have 10 types
                'doctor_id' => rand(1, 10), // Assuming you have 10 doctors
                'department_id' => rand(1, 5), // Assuming you have 5 departments
                'history' => 'Reason for referral',
                'findings' => 'Additional notes for referral',
                'treatment' => 'Treatment information',
                'reason' => 'Additional notes',
                'file_path' => '/path/to/file',
                'card_number' => $cardNumber, // Use patient's card number as referral's card number
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
