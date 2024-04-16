<?php

namespace Database\Seeders;

use App\Models\Admin\Referrtype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferrtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            "vertical",
            "horizontal",
            "diagonal"
         ];
 
         foreach ($types as $type) {
             Referrtype::create([
                 'name' => $type,
                 
             ]);
         }
    }
}
