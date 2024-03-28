<?php

namespace Database\Seeders;

use App\Models\Admin\Hospital;
use Faker\Factory as Faker;

use App\Models\Users\Liaison;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LiaisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();

        $hospitals=Hospital::all();
        foreach($hospitals as $hospital){
     
         Liaison::create(['liaison_officer'=>$faker->unique()->company,'phone_number'=>$faker->unique()->phoneNumber(),'hospital_id'=>$hospital->id]);
        }
    }
}
