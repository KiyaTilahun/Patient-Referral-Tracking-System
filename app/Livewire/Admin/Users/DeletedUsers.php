<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class DeletedUsers extends Component
{
    use WithPagination,Toast;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public $search;
    public $route;
    public function mount()
    {
        
        $this->route = url()->previous();
    }
    public function goBack()
    {
        return redirect($this->route);
    }
    public function restore($id)
    {
$user=User::withTrashed()->find($id);
$user->restore();
$this->render();
    }
    public function delete($id)
    {
        $user=User::withTrashed()->find($id);
$user->forceDelete();
$this->render();

    }
    public function render()
    {
        $hospitalid=auth()->user()->hospital_id;

        $deletedUsers = User::onlyTrashed()->where('hospital_id',$hospitalid)->when($this->search, function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        })->get();

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Full Name'],
            ['key' => 'email', 'label' => 'User Email'],

        ];
        // dd($deletedUsers);


        return view('livewire.admin.users.deleted-users',['deletedusers' => $deletedUsers,'headers' => $headers,
        'sortBy' => $this->sortBy]);
    }
}
