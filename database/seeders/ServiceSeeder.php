<?php

namespace Database\Seeders;

use App\Models\Admin\Department;
use App\Models\Admin\DepartmentService;
use App\Models\Admin\Hospital;
use App\Models\Admin\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

    //     $arr=[      'General Checkups',
    //     'Chronic Disease Management',
    //     'Infectious Disease Care',
    //     'Respiratory Care',
    //     'Cardiovascular Assessments',
    //     'Endocrine Tests',
    //     'Hematology Tests',
    //     'Clinical Chemistry',
    //     'Lipid Profile',
    //     'Blood Pressure Monitoring',
    // ];

    // foreach ($arr as $serviceName) {
    //     Service::create(['name' => $serviceName]); 
    // }

    // DepartmentService
    $services = Service::all(); 
        
    // Get all departments
    $departments = Department::all();
    foreach ($departments as $department) {
        // Get 4 random services from the collection
        $randomServices = $services->random(4);
// dd($randomServices);
        // Attach these services to the department
        $department->services()->attach($randomServices);
    }


// hospital service
    // $hospitals = Hospital::all();
    //     $departmentServices = DepartmentService::all();
 
    //     foreach ($hospitals as $hospital) {
    //         $hospitalDepartments = $hospital->departments;
    //         if ($hospitalDepartments->isEmpty()) {
    //             continue;
    //         }
    //         $randomDepartment = $hospitalDepartments->random(1)->first();
    //         $filteredDepartmentServices = $departmentServices->where('department_id', $randomDepartment->id);

    //         if ($filteredDepartmentServices->isEmpty()) {

    //             continue;
    //         }
    //         $randomDepartmentServices = $filteredDepartmentServices->random(1)->first();
           
    //         $hospital->departmentServices()->attach($randomDepartmentServices ,[
    //             'department_id' => $randomDepartment->id]);

    //     }

    }
}
