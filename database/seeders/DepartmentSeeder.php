<?php

namespace Database\Seeders;

use App\Models\Admin\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Internal Medicine',
            'General Surgery',
            'Pediatrics',
            'Neonatology',
            'Gynecology',
            'Obstetrics',
            'Orthopedics',
            'Intensive Care Unit (ICU)',
            'Ophthalmology',
            'Dentistry',
            'Otorhinolaryngology (ENT)',
            'Psychiatry',
            'Plastic Surgery',
            'Burn Unit',
            'Urology',
            'Physiotherapy',
            'Dermatology',
            'Neurology',
            'Private Wing',
        ];


         foreach ($departments as $department) {
            Department::create([
                'name' => $department,
            ]);
        }
    }
}
