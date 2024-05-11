<?php

namespace Tests\Unit;

use App\Livewire\Hospital\Center\CenterDetail;
use App\Livewire\Hospital\Center\CenterIndex;
use App\Livewire\Hospital\Center\CenterTable;
use App\Livewire\Hospital\Pending\PendingDetail;
use App\Livewire\Hospital\Pending\PendingIndex;
use App\Livewire\Hospital\Pending\PendingTable;
use App\Livewire\RolePermission\RpIndex;
use App\Models\Admin\Hospital;
use App\Models\User;
// use PHPUnit\Framework\TestCase;
use Livewire\Livewire;
use Tests\TestCase;

class HospitalRegistrationTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_centers_pending_and_registred_page(){
        $user = User::factory()->create();

        $this->actingAs($user);
        Livewire::test(PendingIndex::class)
        ->assertStatus(200);
        Livewire::test(CenterIndex::class)
        ->assertStatus(200);
    }
    public function test_pendingandregistered_detail_dispatch_rendered(){
        $user = User::factory()->create();

        $this->actingAs($user);
        Livewire::test(PendingTable::class)
            ->call('show', id: 3)
            ->assertDispatched('hospital_selected');

            Livewire::test(CenterTable::class)
            ->call('show', id: 3)
            ->assertDispatched('hospital_selected'); 

    }
    public function test_pendingandregistered_centers_component_detail_ReloadMethod()
    {
       $hospital=Hospital::factory()->create();
        $pendingcomponent = new PendingDetail();
        $pendingcomponent->reload($hospital->id);

        $this->assertInstanceOf(Hospital::class, $pendingcomponent->detail);
        $this->assertEquals($hospital->id, $pendingcomponent->detail->id); 

        $registeredcomponent = new CenterDetail();
        $registeredcomponent->reload($hospital->id);

        $this->assertInstanceOf(Hospital::class, $registeredcomponent->detail);
        $this->assertEquals($hospital->id, $registeredcomponent->detail->id); 
      
    }
    public function test_pending_DeleteMethod()
    {
        // Arrange
        $hospital = Hospital::factory()->create(); // Create a hospital for testing
        $component = new PendingDetail();
        $component->detail = $hospital;

        // Act
        $component->delete();
        $this->assertDatabaseMissing('hospitals', ['id' => $hospital->id]);// Ensure the hospital is deleted
    }
    public function test_registered_activation_and_deactivation_DeactivationMethod()
    {
        // Arrange
        $center = Hospital::factory()->create(); // Create a center for testing
        $component = new CenterDetail();
        $component->detail = $center;
        $component->deactivation();
        $this->assertEquals(0, $center->refresh()->status); 
        $component->activation();
        $this->assertEquals(1, $center->refresh()->status); 
    }
    
}
