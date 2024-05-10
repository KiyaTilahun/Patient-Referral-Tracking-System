<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Region;
use App\Models\Admin\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Hospital>
 */
class HospitalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company,
            'phone' => $this->faker->phoneNumber,
            'zone' => $this->faker->city,
            'woreda' => $this->faker->optional()->city,
            'country' => 'ETHIOPIA',
            'email' => $this->faker->unique()->safeEmail,
            'filename' => 'no file',
            'status' => true,
            'registered' => false,
            'type_id' => Type::factory(),
            'region_id' => Region::factory(),
        ];
    }
}
