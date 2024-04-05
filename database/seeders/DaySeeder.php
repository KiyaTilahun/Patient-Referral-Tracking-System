<?php

namespace Database\Seeders;

use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $days=Carbon::getDays();
        foreach($days as $day){

            if ('Sunday'!=$day ){
                Day::create(['name'=>$day]);
            }
           
        }
    }
}
