<?php

namespace Database\Seeders;

use App\Models\Admin\DepartmentHospital;
use App\Models\Admin\Hospital;
use App\Models\Users\Doctor;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();
        $numberOfDoctors = 10;


    $hospitals=Hospital::all();
      foreach($hospitals as $hospital){
        $hospitalname=strstr($hospital->name, ' ', true);
$hospitaldeps=DepartmentHospital::where('hospital_id',$hospital->id)->first();

if(count($hospitaldeps)){
    $deparment_id=$hospitaldeps->deprtment_id;
}

            Doctor::create([
                'name' => $faker->unique()->name,
                'email' =>$hospitalname.'@doctor.com',
                'status' => rand(0, 1), // Random status
                'department_id' => $deparment_id??null, // Assuming you have 5 departments
                'hospital_id' => $hospital->id, // Assuming you have 10 hospitals
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
