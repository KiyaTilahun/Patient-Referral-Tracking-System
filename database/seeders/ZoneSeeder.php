<?php

namespace Database\Seeders;

use App\Models\Admin\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Zones=[1=> [
            'Central Tigray',
            'East Tigray',
            'North West Tigray',
            'South Tigray',
            'South East Tigray',
            'West Tigray',
            'Mekele'
        ],2 => [
            'Awsi Rasu',
            'Gabi Rasu',
            'Kilbet Rasu',
            'Fanti Rasu',
            'Hari Rasu',
            'Mahi Rasu',
            'Argobba'
        ],3=>[
            'Agew Awi',
            'East Gojjam',
            'North Gondar',
            'North Shewa',
            'North Wollo',
            'South Gondar',
            'South Wollo',
            'Wag Hemra',
            'West Gojjam',
            'Bahir Dar Special Zone',
            'Oromia Zone'
        ],4 => [
            'Arsi',
            'Bale',
            'Borena',
            'Buno Bedele',
            'East Hararghe',
            'East Shewa',
            'East Welega',
            'Guji',
            'Horo Guduru Welega',
            'Illu Aba Bora',
            'Jimma',
            'Kelam Welega',
            'North Shewa',
            'Southwest Shewa',
            'West Arsi',
            'West Guji',
            'West Hararghe',
            'West Shewa',
            'West Welega',
            'Oromia Special Zone Surrounding Finfinne'
        ],5=> [
            'Sitti',
            'Fafan',
            'Jarar',
            'Erer',
            'Nogob',
            'Dollo',
            'Korahe',
            'Shabelle',
            'Afder',
            'Liben',
            'Dhawa',
            'Jigjiga Special Zone',
            'Tog Wajale Special Zone',
            'Degehabur Special Zone',
            'Gode Special Zone',
            'Kebri Beyah Special Zone',
            'Kebri Dahar Special Zone'
        ],6 => [
            'Asosa',
            'Kamashi',
            'Metekel'
        ],
        7=> [
            'Wolayita',
            'Gamo',
            'Gofa',
            'Gedeo',
            'South Omo',
            'Ari',
            'Konso',
            'Gardula',
            'Burji',
            'Koore',
            'Basketo',
            'Ale',
        ],
        8=> [
            'Anywaa',
            'Majang',
            'Nuer'
        ],
        9 => [
            'Amir-Nur',
            'Abadir',
            'Shenkor',
            'Jin',
            'Eala',
            'Aboker',
            'Hakim',
            'Sofi',
            'Erer',
            'Dire-Teyara'
        ],10=> [
            'Aleta Chuko',
            'Aleta Wondo',
            'Arbegona',
            'Aroresa',
            'Hawassa Zuria',
            'Bensa',
            'Bona Zuria',
            'Boricha',
            'Bursa',
            'Chere',
            'Dale',
            'Dara',
            'Gorche',
            'Hawassa',
            'Hula',
            'Loko Abaya',
            'Malga',
            'Shebedino',
            'Wonsho',
            'Wondo Genet'
        ],11=> [
            'Bench Sheko',
            'Dawro',
            'Keffa',
            'Sheka',
            'Konta',
            'West Omo'
        ],12 => [
            'East Gurage',
            'Gurage',
            'Hadiya',
            'Halaba',
            'Kembata',
            'Siltʼe',
            'Yem',
            'Kebena Special Woreda',
            'Mareko Special Woreda',
            'Tembaro Special Woreda'
        ],13 =>[
            'Akaky Kaliti',
            'Addis Ketema',
            'Arada',
            'Bole',
            'Gullele',
            'Kirkos',
            'Kolfe Keranio',
            'Lideta',
            'Yeka',
            'Nifas Silk-Lafto',
            'Lemi-Kura'
        ],
        14=>[
           'gende kore',
           'menaheriya',
           'tailwan'
        ]
        ];
        
        
        foreach ($Zones as $region => $zones) {
           
         
         
            // Attach each zone to the region
            
            foreach ($zones as $zoneName) {
             Zone::create(['name'=>$zoneName,'region_id'=>$region]);
        
            }
        }
    }
}
