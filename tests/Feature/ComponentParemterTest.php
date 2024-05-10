<?php

namespace Tests\Feature;

use App\Livewire\Admin\AllPatients;
use App\Livewire\Admin\AllReferrals;
use App\Livewire\Admin\Department\DepIndex;
use App\Livewire\Hospital\Inbound\InboundIndex;
use App\Livewire\Patient\PatientIndex;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ComponentParemterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function  test_patient_page()
    {
       
        $user = User::factory()->create();

        $this->actingAs($user);
        Livewire::test(PatientIndex::class)
            ->assertStatus(200);
    }
    
    public function test_allreferrals_page()
    {

        $user = User::factory()->create();

        $this->actingAs($user);
        Livewire::test(AllReferrals::class)
            ->assertStatus(200);
    }


    // 
    public function test_allpatients_page()
    {

        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(AllPatients::class)
            ->assertStatus(200);
    }

    public function test_departments_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        Livewire::test(DepIndex::class)
            ->assertStatus(200);
    }
    public function test_inbound_referrals()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        Livewire::test(InboundIndex::class)
            ->assertStatus(200);
    }
}
