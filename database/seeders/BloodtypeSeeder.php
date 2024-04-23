<?php

namespace Database\Seeders;

use App\Models\Admin\Bloodtype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodTypes = [
            "A+",
            "A-",
            "B+",
            "B-",
            "AB+",
            "AB-",
            "O+",
            "O-",
        ];
        
 
        foreach ($bloodTypes as $type) {
            Bloodtype::create([
                'name' => $type,
            ]);
        }
    }
}
