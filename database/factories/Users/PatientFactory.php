<?php

namespace Database\Factories\Users;

use App\Models\Admin\Bloodtype;
use App\Models\Admin\Gender;
use App\Models\Admin\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //

            'name' => $this->faker->name,
            'dob' => $this->faker->date,
            'card_number' => $this->faker->unique()->creditCardNumber,
            'email' => $this->faker->optional()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'hospital_id' => Hospital::factory(),
            'gender_id' => Gender::factory(),
            'bloodtype_id' => Bloodtype::factory(),
        ];
    }
}
