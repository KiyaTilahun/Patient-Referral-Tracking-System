<?php

namespace Database\Seeders;

use App\Models\Admin\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            "Tigray",
            "Afar",
            "Amhara",
            "Oromia",
            "Somali",
            "Benishangul_Gumuz",
            "South_Ethiopia",
            "Gambela",
            "Harari","Sidama","Southwest_Peoples","Central_Ethiopia","Adiss_Ababa","DireDawa",
        ];

        foreach ($regions as $region) {
            Region::create([
                'name' => $region,
                
            ]);
        }
    }
}
