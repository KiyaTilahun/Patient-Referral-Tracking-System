<?php

namespace Tests\Feature\Integration;

use App\Models\Referral\Referral;
use App\Models\Users\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_patient_index_authenticated(): void
    {
        
        $patient = Patient::factory()->create();
        $token = $patient->createToken('authpatient')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/patient/' . $patient->card_number);

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson([
            'patient' => [
                'Full Name' => $patient->name,
                'Referral Id' => $patient->card_number,
                'Phone Number' => $patient->phone,
                'Gender' => $patient->gender->name,
                'Email' => $patient->email,
                'Registering Center' => $patient->hospital->name,
            ],
            'referrals' => [],
        ]);
    }


    public function test_referral_specific_authenticated(): void
    {
        $patient = Patient::factory()->create();
    
        $token = $patient->createToken('authpatient')->plainTextToken;
        $referral = Referral::factory()->create(['card_number' => $patient->card_number]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/referral/' . $patient->card_number . '/' . $referral->referral_date);

        $response->assertStatus(Response::HTTP_OK);

      
    }
}
