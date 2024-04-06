<?php

namespace Database\Seeders;

use App\Models\Admin\Appointmentslot;
use App\Models\Admin\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $hospital = Hospital::where('id', 1)->first();
       
       
    if ($hospital) {
    
        $departments = $hospital->departments()->wherePivot('active', true)->limit(6)->get();

        foreach ($departments as $department) {
            Appointmentslot::create([
                'department_id' => $department->id,
                'date' => now()->toDateString(),
                'hospital_id' => $hospital->id,
                'slotused' => 1,
            ]);
        }
    }
    }
}
