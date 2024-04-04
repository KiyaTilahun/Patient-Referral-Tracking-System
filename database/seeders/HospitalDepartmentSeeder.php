<?php

namespace Database\Seeders;

use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospitals = Hospital::all();
        $departments = Department::all();

        // Define the number of departments to associate with each hospital
        $departmentsPerHospital = 5; // Change this according to your requirement

        
        foreach ($hospitals as $hospital) {
            $randomDepartments = $departments->shuffle()->take($departmentsPerHospital);

       
            foreach ($randomDepartments as $department) {
              
                $hospital->departments()->attach($department->id);
            }
        }
    }
}
