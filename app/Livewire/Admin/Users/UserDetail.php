<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserDetail extends Component
{
public $detail;

    #[On('user_selected')]
    public function reload($id)
    {
        
        $this->detail = User::findOrFail($id);
        
        $this->render();
    }

    public function edituser(){

        $this->redirect(route('edituser', $this->detail->id));
    }

    public function render()
    {
        return view('livewire.admin.users.user-detail',['detail' => $this->detail]);
    }
}
