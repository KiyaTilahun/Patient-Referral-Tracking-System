<?php

namespace Database\Seeders;

use App\Models\Admin\DepartmentHospital;
use App\Models\Admin\Hospital;
use App\Models\User;
use App\Models\Users\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;


class SuperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); 
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // Replace 'your_password_here' with the desired password
            // Assuming you have a column named 'role' to store user roles
            'remember_token' => Str::random(10),
        ])->assignRole('superadmin');
        // User::create([
        //     'name' => 'Kiya Tilahun',
        //     'email' => 'kiya@gmail.com',
        //     'email_verified_at' => now(),
        //     'hospital_id' => 1,
        //     'password' => Hash::make('12345678'), // Replace 'your_password_here' with the desired password
        //     // Assuming you have a column named 'role' to store user roles
        //     'remember_token' => Str::random(10),
        // ])->assignRole('staff');

        // User::create([
        //     'name' => 'Kiya Tilahun',
        //     'email' => 'kebe@gmail.com',
        //     'email_verified_at' => now(),
        //     'hospital_id' => 2,
        //     'password' => Hash::make('12345678'), // Replace 'your_password_here' with the desired password
        //     // Assuming you have a column named 'role' to store user roles
        //     'remember_token' => Str::random(10),
        // ])->assignRole('doctor');


        $hospitalss = Hospital::all(); // Get the number of hospitals

        foreach($hospitalss as $hospital){

            $hospitalname=strstr($hospital->name, ' ', true);
                 User::create([
                'name' => $faker->name,
                'email' => $hospitalname.'@admin.com',
                'email_verified_at' => now(),
                'hospital_id' => $hospital->id,
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
            ])->assignRole('admin');

            User::create([
                'name' => $faker->name,
                'email' => $hospitalname.'@staff.com',
                'email_verified_at' => now(),
                'hospital_id' => $hospital->id,
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
            ])->assignRole('staff');
    

           
            $hospitaldeps=DepartmentHospital::where('hospital_id',$hospital->id)->first();
            
             if($hospitaldeps!=null){
                $deparment_id=$hospitaldeps->department_id;
            }
            
            $doctorname="Dr.".$faker->unique()->name;


            User::create([
                'name' => $doctorname,
                'email' => $hospitalname.'@doctor.com',
                'email_verified_at' => now(),
                'hospital_id' => $hospital->id,
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
            ])->assignRole('doctor');

                        Doctor::create([
                            'name' => $doctorname,
                            'email' =>$hospitalname.'@doctor.com',
                            'status' => rand(0, 1), // Random status
                            'department_id' => $deparment_id??null, // Assuming you have 5 departments
                            'hospital_id' => $hospital->id, // Assuming you have 10 hospitals
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);


        }
        // for ($i = 1; $i <= count($hospitalCount); $i++) {
        //     User::create([
        //         'name' => $faker->name,
        //         'email' => "",
        //         'email_verified_at' => now(),
        //         'hospital_id' => $i,
        //         'password' => Hash::make('12345678'),
        //         'remember_token' => Str::random(10),
        //     ])->assignRole('admin');
        // }
    }
}
