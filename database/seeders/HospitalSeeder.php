<?php

namespace Database\Seeders;

use App\Models\Admin\Hospital;
use App\Models\Admin\Region;
use App\Models\Admin\Type;
use App\Models\Admin\Zone;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $hospitalType = Type::pluck('id'); // Assuming you have a hospital type already created

        $regions = Region::pluck('id'); // Get the IDs of all regions in the database
    $faker=Faker::create();

foreach($regions as $region){
foreach($hospitalType as $type){
    $zones=Zone::where('region_id',$region)->pluck('name');
    for ($i = 0; $i <2; $i++) {

        if($type==1){
            $name='Primary';
        }
        elseif($type==2){
            $name='Secondary';
        }
        else{
            $name='Tertiary';  
        }
// dd("hello");
        Hospital::create([
            'name' =>ucfirst( $faker->unique()->word) .' '.$name. ' HealthCenter',
            'phone' => $faker->phoneNumber(),
            'email' => $faker->unique->email(),
            'registered'=>1,
            'type_id' => $type,
            'region_id' => $region,
            'country' => 'ETHIOPIA',
            'woreda' => '1',
            'zone' =>  $zones->random(),
            'remember_token' => Hash::make('password') // Temporary placeholder for the remember_token
        ]);
    }

}

}


    // for ($i = 0; $i < 20; $i++) {
    //     Hospital::create([
    //         'name' => $faker->unique()->company . ' Hospital',
    //         'phone' => $faker->phoneNumber(),
    //         'email' => $faker->unique->email(),
    //         'registered'=>1,
    //         'type_id' => $hospitalType->random(),
    //         'region_id' => $regions->random(),
    //         'country' => 'ETHIOPIA',
    //         'woreda' => '1',
    //         'zone' => 'other',
    //         'remember_token' => Hash::make('password') // Temporary placeholder for the remember_token
    //     ]);
    // }
    // for ($i = 0; $i < 5; $i++) {
    //     Hospital::create([
    //         'name' => $faker->unique()->company . ' Hospital',
    //         'phone' => $faker->phoneNumber(),
    //         'email' => $faker->unique->email(),
    //         'type_id' => 1,
    //         'region_id' => $regions->random(),
    //         'country' => 'ETHIOPIA',
    //         'woreda' => '1',
    //         'zone' => 'other',
    //         'remember_token' => Hash::make('password') // Temporary placeholder for the remember_token
    //     ]);
    // }

    }
}
