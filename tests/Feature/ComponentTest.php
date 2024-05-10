<?php

namespace Tests\Feature;

use App\Livewire\Admin\AllPatients;
use App\Livewire\Admin\AllReferrals;
use App\Livewire\Admin\Department\DepIndex;
use App\Livewire\Dashboard;
use App\Livewire\Hospital\Center\CenterIndex;
use App\Livewire\Hospital\Inbound\InboundIndex;
use App\Livewire\Hospital\Pending\PendingIndex;
use App\Livewire\Hospital\Register;
use App\Livewire\Patient\PatientIndex;
use App\Livewire\RolePermission\RpIndex;
use App\Models\Admin\Hospital;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_page()
    {
        Livewire::test(Register::class)
            ->assertStatus(200);
    }
    public function test_pending_page()
    {
        Livewire::test(PendingIndex::class)
            ->assertStatus(200);
    }
    public function test_centers_page()
    {
        Livewire::test(CenterIndex::class)
            ->assertStatus(200);
    }
    public function test_roleandpermission_page(){
        Livewire::test(RpIndex::class)
        ->assertStatus(200);
    }
   
    
}
