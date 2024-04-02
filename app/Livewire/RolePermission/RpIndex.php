<?php

namespace App\Livewire\RolePermission;

use Livewire\Component;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class RpIndex extends Component
{
    public bool $myModal1 = false;
    
   


    public function show($id){
    
        $this->dispatch('role_selected', id: $id);
    
    }
    
    public function render()
    {
        $roles = Role::all();
        $permissions = ModelsPermission::all();
        return view('livewire.role-permission.rp-index',['roles'=>$roles,'permissions'=>$permissions]);
    }
}
