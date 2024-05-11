<?php

namespace Tests\Unit;

use App\Livewire\Admin\Adduser;
use App\Models\User;
use App\Models\Users\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;


class UserCreateTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;

    public function test_adduser_has_wired_fields_and_methods(): void
    {
        // Arrange & Act & Assert
        $user = User::factory()->create();
        $this->actingAs($user);
        // Act & Assert
        Livewire::test(Adduser::class)
            ->set('name', $user->name)
            ->set('email',  $user->name)
            ->set('phone',+251943072433 )
            ->set('dep', 1)
            ->set('hospital', $user->hospital_id) 
            ->call('register')->assertHasNoErrors('phone','name','email','dep','hospital');
      
    }

    public function test_adduser_uniqueemail_checker_methods(): void
    {
    
        $user = User::factory()->create();
        $user2=User::factory()->create();
        $this->actingAs($user);
        Livewire::test(Adduser::class)
            ->set('name', $user->name)
            ->set('email',  $user->email)
            ->set('phone',+251943072433 )
            ->set('dep', 1)
            ->set('hospital', $user->hospital_id) 
            ->call('register')->assertHasNoErrors('phone','name','email','dep','hospital');

            Livewire::test(Adduser::class)
            ->set('name', $user2->name)
            ->set('email',  $user->email) 
            ->set('phone',+251943072433 )
            ->set('dep', 1)
            ->set('hospital', $user2->hospital_id) 
            ->call('register')->assertHasErrors('email');
      
    }

    public function test_adduser_registeredchecker_methods(): void
    {
        // Arrange & Act & Assert

        
       $user=User::factory()->create();

        $this->actingAs($user);
       
        Livewire::test(Adduser::class)
            ->set('name', $user->name)
            ->set('email',  $user->email)
            ->set('phone',+251943072433 )
            ->set('dep', 1)
            ->set('hospital', $user->hospital_id) 
            ->call('register');

            $usercount=User::count();

            $this->assertEquals(1
            ,$usercount);
        
    }
   

}
