<?php

namespace App\Livewire\RolePermission;

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{

    public $role;



    #[On('role_selected')]
    public function show($id)
    {
        
        $this->role = Role::findOrFail($id);
        
        $this->render();
    }
    public function render()
    {
        return view('livewire.role-permission.role-edit');
    }
}
