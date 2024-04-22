<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;
use Spatie\Permission\Models\Role;

class UserDetail extends Component
{
    use Toast;

public $detail;
public bool $myModal1=false;
public $updatename;
public $allroles;
public $role=[];


    #[On('user_selected')]
    public function reload($id)
    {
        
        $this->reset('role');
        $this->detail = User::findOrFail($id);
        $this->updatename=$this->detail->name;
        $role =$this->detail->roles;

        $this->allroles=Role::whereNotIn('name', ['superadmin'])->get()->pluck('name')->toArray();
        // dd($this->allroles);
        foreach($role as $rol){
            $this->role[]=$rol->name;
        }
      
        
        $this->render();
    }

    public function edituser(){

        $this->myModal1=true;
   

        // $this->redirect(route('edituser', $this->detail->id));
    }

    public function roleupdate(){

        
        $this->validate(
            [
                'role' => ['required'],
            ]
        );

        $kk=$this->detail->syncRoles($this->role);
// dd($kk);
$this->success( 'User Roles Edited Successfully');

$this->render();
$this->myModal1=false;
 $this->dispatch('user_edited');


    }

    public function render()
    {
        return view('livewire.admin.users.user-detail',['detail' => $this->detail]);
    }
}
