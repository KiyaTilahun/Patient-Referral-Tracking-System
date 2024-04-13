<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Traits\HasRoles;

class UserTable extends Component
{
use WithPagination;


    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public $search;
    

    public function show($id){
    
        $this->dispatch('user_selected', id: $id);
    
    }
    public function render()
    {

        $user = auth()->user();
        $user=User::where('id',$user->id)->first();

    if ($user->hasRole('superadmin')) {
        // Fetch all users in the system
        // dd("superadmin");
        $users = User::whereHas('hospital', function ($query) {
                        $query->where('registered', '1');
                    })
                    ->when($this->search, function ($query) {
                        $query->where('name', 'LIKE', '%' . $this->search . '%');
                    })->withAggregate('hospital','name')->withAggregate('roles','name')
                    ->orderBy(...array_values($this->sortBy))
                    ->paginate(5);

                    // $users=User::withAggregate('hospital','name')->get();

        //  $users=count($users);

    } elseif ($user->hasRole('admin')) {
        // Fetch users dedicated to the health center of the logged-in admin
        $users = User::where('hospital_id', $user->hospital_id)
                    ->when($this->search, function ($query) {
                        $query->where('name', 'LIKE', '%' . $this->search . '%');
                    })->withAggregate('hospital','name')->withAggregate('roles','name')
                    ->orderBy(...array_values($this->sortBy))
                    ->paginate(5);
    }


    $headers = [
            
        ['key' => 'name', 'label' => 'User Name'],
        ['key' => 'hospital_name', 'label' => 'Center Name'],
        ['key' => 'roles_name', 'label' => 'Status'],      # <-- nested attributes
  
    ];
        return view('livewire.admin.users.user-table',['users'=>$users,'headers'=>$headers,
        'sortBy'=> $this->sortBy]);
    }
}
