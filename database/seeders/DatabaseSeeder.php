<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin\Bloodtype;
use App\Models\Admin\Department;
use App\Models\Admin\ReferralType;
use App\Models\DayDepartment;
use App\Models\Referral\Referral;
use App\Models\Users\Doctor;
use App\Models\Users\Liaison;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            TypeSeeder::class,
            RegionSeeder::class,
            ZoneSeeder::class,
            HospitalSeeder::class,
            LiaisonSeeder::class,
            DepartmentSeeder::class,
            DoctorSeeder::class,
            BloodtypeSeeder::class,
            GenderSeeder::class,
            PatientSeeder::class,
            ReferrtypeSeeder::class,
            StatustypeSeeder::class,
            ReferralSeeder::class,
            RolePermissionSeeder::class,
            SuperSeeder::class,
            HospitalDepartmentSeeder::class,
            DaySeeder::class,
            DayDepartmentSeeder::class,
            SpecialdaysSeeder::class,
            HolidaylistSeeder::class

            // AppointmentslotSeeder::class,

            



        ]);
    }
}
