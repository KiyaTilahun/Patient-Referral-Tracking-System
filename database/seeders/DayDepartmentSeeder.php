<?php

namespace Database\Seeders;

use App\Models\Admin\DepartmentHospital;
use App\Models\Day;
use App\Models\DayDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DayDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $days = Day::pluck('id')->toArray();
        // $departmentHospitals = DepartmentHospital::all();
        $departmentHospitals = DepartmentHospital::all();

        $dayIds = range(1, 6);

        foreach ($departmentHospitals as $departmentHospital) {
            shuffle($dayIds);
            $randomDays = array_slice($dayIds, 0, 3);

            foreach ($randomDays as $dayId) {
                DayDepartment::create([
                    'day_id' => $dayId,
                    'department_hospital_id' => $departmentHospital->id,
                    'hospital_id' => $departmentHospital->hospital_id,
                ]);
            }
        }
    }
}
