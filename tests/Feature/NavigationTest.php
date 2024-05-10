<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Livewire\Volt\Volt;
use Tests\TestCase;

class NavigationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_redirect(): void
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();
        $component = Volt::test('pages.auth.login')
            ->set('form.email', $user->email)
            ->set('form.password', 'password');
        $component->call('login');
        $component->assertHasNoErrors();
        $component->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticated();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $component = Volt::test('pages.auth.login')
            ->set('form.email', $user->email)
            ->set('form.password', 'wrong-password');

        $component->call('login');

        $component->assertHasErrors();
        $component->assertNoRedirect();

        $this->assertGuest();
    }
    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test('App\Livewire\Logout')
            ->call('logout')
            ->assertRedirect('/login');

        $this->assertGuest();
    }

    
}
