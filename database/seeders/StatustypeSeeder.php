<?php

namespace Database\Seeders;

use App\Models\Admin\Statustype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatustypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            "pending",
            "completed",
            "diagonal"
         ];
 
         foreach ($types as $type) {
             Statustype::create([
                 'name' => $type,
                 
             ]);
         }
    }
}
