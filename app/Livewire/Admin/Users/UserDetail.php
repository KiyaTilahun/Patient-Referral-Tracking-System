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
public $selection;
public $userole;



    #[On('user_selected')]
    public function reload($id)
    {
        
        $this->reset('role');
        $this->detail = User::findOrFail($id);
        $this->userole=$this->detail->getRoleNames()->first();
        $this->selection=$this->userole;
        $this->updatename=$this->detail->name;
        $role =$this->detail->roles;

        $this->allroles=Role::whereNotIn('name', ['superadmin'])->get()->pluck('name')->toArray();
        // dd($this->allroles);
        
      
        
        $this->render();
    }

    public function try_delete(){
      
        $this->dispatch('deletedialog', [
            
        ]);
        
    }
    #[On('godelete')]
    public function delete()
    {


       
        $this->detail->delete();
        
        $this->dispatch('deleted');
        $this->reset('detail');
        $this->render();
    }

    public function edituser(){

        $this->myModal1=true;
   

        // $this->redirect(route('edituser', $this->detail->id));
    }

    public function roleupdate(){

        
        $this->validate(
            [
                'selection' => ['required'],
            ]
        );

        $this->reset('role');
            $this->role[]=$this->selection;
       
            //  $this->detail->removeRoles();

            foreach ($this->detail->roles as $role) {
                $this->detail->removeRole($role);
            }
            // dd($this->role);
        $kk=$this->detail->syncRoles($this->role);
        // dd($kk);
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
