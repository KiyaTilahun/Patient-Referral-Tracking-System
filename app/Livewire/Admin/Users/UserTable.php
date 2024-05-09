<?php

namespace App\Livewire\Admin\Users;

use App\Models\Admin\Hospital;
use App\Models\Admin\Region;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserTable extends Component
{
    use WithPagination;


    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public $search;
    public $selectedhospital;
    public $exportadmins;
    public $allhospitals;
    public $allroles;
    public $selectedrole;



    public function mount()
    {
        $this->allhospitals = Hospital::orderBy('name', 'asc')->get();
        $this->allroles = Role::where('name', '!=', 'superadmin')->get();

    }
    public function printpdf()
    {
        $user = auth()->user();
        $user = User::where('id', $user->id)->first();
        if ($user->hasRole('superadmin')) {
            $this->exportadmins = User::role('admin')->whereHas('hospital', function ($query) {
                $query->where('registered', '1');
            })
                ->when($this->search, function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->search . '%');
                })->when($this->selectedhospital, function ($query) {
                    $query->where('hospital_id', $this->selectedhospital);
                })->withAggregate('hospital', 'name')->withAggregate('roles', 'name')
                ->orderBy(...array_values($this->sortBy))
                ->get();
        } else {
        }

        // dd($this->exportcenters);
        $admins = $this->exportadmins;
        $day = now()->format('d/m/Y');

        $pdf =  Pdf::loadView('utils.adminspdf', compact('admins', 'day'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'centers.pdf');
    }
    public function show($id)
    {

        $this->dispatch('user_selected', id: $id);
    }
    #[On('user_edited')]
    public function reload()
    {


        $this->render();
    }
    #[On('deleted')]
    public function render()
    {

        $user = auth()->user();
        $user = User::where('id', $user->id)->first();

        if ($user->hasRole('superadmin')) {
            // Fetch all users in the system
            // dd("superadmin");
            $users = User::role('admin')->whereHas('hospital', function ($query) {
                $query->where('registered', '1');
            })
                ->when($this->search, function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->search . '%');
                })->when($this->selectedhospital, function ($query) {
                    $query->where('hospital_id', $this->selectedhospital);
                })->withAggregate('hospital', 'name')->withAggregate('roles', 'name')
                ->orderBy(...array_values($this->sortBy))
                ->paginate(5);
            // dd($users);
            // $users=User::withAggregate('hospital','name')->get();

            //  $users=count($users);

        } else {
            // Fetch users dedicated to the health center of the logged-in admin
            $users = User::where('hospital_id', $user->hospital_id)->where('id','!=',$user->id)
                ->when($this->search, function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->search . '%');
                })->when($this->selectedrole, function ($query) {
                    $query->role($this->selectedrole);
                })->withAggregate('hospital', 'name')->withAggregate('roles', 'name')
                ->orderBy(...array_values($this->sortBy))
                ->paginate(5);
        }

        $headers = [

            ['key' => 'name', 'label' => 'User Name'],
            ['key' => 'hospital_name', 'label' => 'Center Name'],
            ['key' => 'roles_name', 'label' => 'Role'],      # <-- nested attributes

        ];
        return view('livewire.admin.users.user-table', [
            'users' => $users, 'headers' => $headers,
            'sortBy' => $this->sortBy
        ]);
    }
}
