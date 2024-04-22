<?php

namespace Database\Seeders;

use App\Models\Admin\Specialdays;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialdaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $holidays = [
            'Ethiopian New Year' => '2024/09/12',
            'Cross Finding Day' => '2023/09/28',
            'Ethiopian Christmas' => '2024/01/07',
            'Ethiopian Epiphany' => '2024/01/20',
            'Adwa' => '2024/03/02',
            'Labour Day' => '2024/05/01',
            'Good Friday' => '2024/05/03',
            'Easter' => '2024/05/05',
            'Patriot\'s Day' => '2024/05/05',
            'Derg Downfall' => '2024/05/28',
        ];

        foreach ($holidays as $name => $date) {
            Specialdays::create([
                'name' => $name,
                'date' => \Carbon\Carbon::createFromFormat('Y/m/d', $date),
            ]);
        }
    }
}
