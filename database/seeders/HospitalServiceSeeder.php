<?php

namespace Database\Seeders;

use App\Models\Admin\Department;
use App\Models\Admin\DepartmentHospital;
use App\Models\Admin\DepartmentService;
use App\Models\Admin\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        $hospitals = Hospital::all();

        foreach ($hospitals as $hospital) {

            $hospitaldeps=DepartmentHospital::where('hospital_id',$hospital->id)->pluck('department_id');

            foreach ($hospitaldeps as $departments){

                $depsservice = DepartmentService::where('department_id', $departments)->inRandomOrder()->pluck('id')->take(2);

            //   dd($hospital);
                    $hospital->departmentServices()->attach($depsservice,['department_id' => $departments]);

                
                
            }
        }

  

   
    }
}
