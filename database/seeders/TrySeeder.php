<?php

namespace Database\Seeders;

use App\Models\Admin\Hospital;
use App\Models\Admin\Region;
use App\Models\Admin\Type;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

         Type::factory()->create();

    }
}
