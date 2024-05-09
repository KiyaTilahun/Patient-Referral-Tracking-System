<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Mary\Traits\Toast;

class EditPassword extends Component
{
    use Toast;
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
public $route;


    /**
     * Update the password for the currently authenticated user.
     */
    public function mount(){
        $this->route = url()->previous();

    }
    public function goBack()
    {
    
        return redirect($this->route);
    }
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        $user=User::where('id',auth()->user()->id)->first();
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->warning('password-updated');
    }
    public function render()
    {
        return view('livewire.edit-password');
    }
}
