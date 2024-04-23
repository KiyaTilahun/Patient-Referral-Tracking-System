<?php

namespace Database\Seeders;

use App\Models\Admin\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $genders = [
            "Male",
            "Female",
         ];
         foreach ($genders as $type) {
            Gender::create([
                'name' => $type,
                
            ]);
        }
    }
}
