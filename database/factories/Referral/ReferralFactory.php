<?php

namespace Database\Factories\Referral;

use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use App\Models\Admin\Referrtype;
use App\Models\Admin\Statustype;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Referral\Referral>
 */
class ReferralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $patient = Patient::factory()->create();
        return [
            //

            'card_number' => $patient->card_number,  // Reference to a Patient's card number
            'referral_date' => $this->faker->date(),
            'referring_hospital_id' => Hospital::factory(),
            'receiving_hospital_id' => Hospital::factory(),
            'referrtype_id' => Referrtype::factory(),
            'department_id' => Department::factory(),
            'statustype_id' => Statustype::factory(),
            'history' => $this->faker->paragraph(),
            'findings' => $this->faker->paragraph(),
            'treatment' => $this->faker->paragraph(),
            'reason' => $this->faker->sentence(),
            'file_path' => $this->faker->optional()->filePath(),
        ];
    }
}
