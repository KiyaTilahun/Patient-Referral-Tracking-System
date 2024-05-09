<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mary\Traits\Toast;

class EditProfile extends Component
{
    use Toast;
    public string $name = '';
    public string $email = '';
public $route;
    /**
     * Mount the component.
     */

    public function mount(): void
    {
        $this->route = url()->previous();
        $this->name = Auth::user()->name;
       
        $this->email = Auth::user()->email;
    }
    public function goBack()
    {
    
        return redirect($this->route);
    }

    public function updateProfileInformation(): void
    {
        $id = auth()->user()->id;
        $user=User::where('id',$id)->first();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255','unique:users,email' ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // $this->dispatch('profile-updated', name: $user->name);
        $this->warning('Profile Updated');
    }
    public function render()
    {
        return view('livewire.edit-profile');
    }
}
