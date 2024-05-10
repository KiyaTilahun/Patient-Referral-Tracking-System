<?php

namespace Tests\Feature\Integration;

use App\Models\Admin\Hospital;
use App\Models\Admin\Region;
use App\Models\Admin\Type;
use App\Models\Referral\Referral;
use App\Models\Users\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabasesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_region_database_create(){

        
        $region = Region::factory()->create();
        $this->assertDatabaseHas('regions', [
            'id' => $region->id,
            'name' => $region->name,
        ]);
    }
    public function test_type_database_create(){
        $region = Type::factory()->create();
        $this->assertDatabaseHas('types', [
            'id' => $region->id,
            'name' => $region->name,
        ]); 
    }
    public function test_hospital_database_create(){
        $hospital = Hospital::factory()->create();
        $this->assertDatabaseHas('hospitals', [
            'id' => $hospital->id,
            'name' => $hospital->name,
            'phone' => $hospital->phone,
            'zone' => $hospital->zone,
            'woreda' => $hospital->woreda,
            'country' => 'ETHIOPIA',
            'email' => $hospital->email,
            'filename' => 'no file',
            'status' => true,
            'registered' => false,
            'type_id' => $hospital->type_id,
            'region_id' => $hospital->region_id
        ]); 
    }

    public function test_patients_database_create(){
        $patient = Patient::factory()->create();
    $this->assertDatabaseHas('patients', [
        'id' => $patient->id,
        'name' => $patient->name,
        'dob' => $patient->dob,
        'card_number' => $patient->card_number,
        'email' => $patient->email,
        'phone' => $patient->phone,
        'hospital_id' => $patient->hospital_id,
        'gender_id' => $patient->gender_id,
        'bloodtype_id' => $patient->bloodtype_id,
    ]);
}
public function test_referrals_database_create(){
    $referral = Referral::factory()->create();

$this->assertDatabaseHas('referrals', [
    'id' => $referral->id,
    'card_number' => $referral->card_number,
    'referring_hospital_id' => $referral->referring_hospital_id,
    'receiving_hospital_id' => $referral->receiving_hospital_id,
]);}
}
