<?php

namespace App\Livewire\RolePermission;

use Livewire\Component;
use Mary\Traits\Toast;
// use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission ;
use Spatie\Permission\Models\Role;


class RpIndex extends Component
{
    use Toast;

    public bool $myModal1 = false;
    public bool $myModal2 = false;

    public $selectedpermission;
    public $selectedrole;

    public $permissionsrole=[];
    public $updatedpermission;
    public $updatedrole;
    public $permissions;
    
   
    public function mount(){
       
    }


    public function show($id){
    
        $this->dispatch('role_selected', id: $id);
    
    }

   public function showperm( $perm){

    $this->reset('selectedpermission');

$this->selectedpermission=Permission::where('id',$perm)->first();
$this->updatedpermission=$this->selectedpermission->name;
$this->myModal1=true;

// dd($this->selectedpermission);

   }

   public function showrole($role){

    $this->reset('selectedrole');
    $this->reset('permissionsrole');


    $this->selectedrole = Role::where('id', $role)->firstOrFail();
    
    $this->updatedrole=$this->selectedrole->name;
    // dd($roles->permissions);
   
    foreach ($this->selectedrole->permissions as $role) {
        // dd($role()->permissions->id);
        $this->permissionsrole[]= $role->id;

    }
    
$this->myModal2=true;
// dd( $this->permissionsrole);

    
       }


   public function updatepermission(){

   
    $validatedData = $this->validate([
        'updatedpermission' => 'required|regex:/^[a-zA-Z\s_]+$/',
   
    ]);
    $lowercasedPermission = strtolower($this->updatedpermission);
    $this->selectedpermission->update(['name'=>$lowercasedPermission]);
    $this->myModal1=false;
    $this->warning( 'Permission renamed to '.$lowercasedPermission);


   }
   public function updaterole(){

    $validatedData = $this->validate(
        [
            'updatedrole' => 'required|regex:/^[a-zA-Z\s_]+$/',
            'permissionsrole'=>'required'
        ]
    );

    $lowercasedPermission = strtolower($this->updatedrole);
    $this->selectedrole->update(['name'=>$lowercasedPermission]);
    $this->myModal2=false;
    // $this->selectedpermission->syncPermissions([]);
   
    $data = array();
foreach ($this->permissionsrole as $key => $item){
   $data[$key] = (int)$item;
}
// dd($data);

    $this->selectedrole->syncPermissions($data);
    $this->warning( 'Role '.$lowercasedPermission.' Updated');

//    $this->reset('permissionsrole');
   $this->reset('selectedrole');
    $this->permissionsrole=[];


   }

    
    public function render()
    {
        $roles = Role::all();
        $this->permissions = Permission::all();
        return view('livewire.role-permission.rp-index',['roles'=>$roles,'permissions'=>$this->permissions]);
    }
}
