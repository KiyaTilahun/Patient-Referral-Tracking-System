<?php

namespace Database\Seeders;

use App\Models\Admin\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            "primary",
            "secondary",
            "tertiary"
         ];
 
         foreach ($types as $type) {
             Type::create([
                 'name' => $type,
                 
             ]);
         }
    }
}
