<?php

namespace Database\Seeders;

use App\Models\Admin\Holidaylist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
         
           
            "Easter"=>"2024-05-05", 
            "Patriot's Day"=>"2024-05-05", 
            "Derg Downfall"=>"2024-05-28"
         ];
 
         foreach ($types as $date) {
             Holidaylist::create([
                 'holiday' => $date,
                 
             ]);
         }
    }
}
