<?php

namespace App\Livewire\Admin\Department;

use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class AddIndex extends Component
{
    use Toast;
    // public $center_deps;
    public $hospital;
    public $deps;
    public $newdep = [];
    public $numberchoosed = 0;
    public $departmentlist = [];




    public function mount()
    {
    }

    public function adddep()
    {

        $this->validate(
            [
                'departmentlist' => ['required'],
            ]
        );
        $this->hospital->departments()->attach($this->departmentlist);
        $this->success(count($this->departmentlist) . ' Department added');
        $this->resetValidation();
       $this->reset();
    }


    public function detachdep($id){

        // $this->dispatch('swal_remdep');
        $this->hospital->departments()->detach($id);
        $dep=Department::where('id',$id)->first();
         $this->warning($dep->name . ' Department is removed successfully');
      

         $this->reset();
         $this->dispatch('reload');
    }

    #[On(['reload'])]
    public function render()
    {
        $this->numberchoosed = count($this->departmentlist);

        //     $this->dispatch('refresh-me');

        //    $this->dispatch('reload_select');


        $this->hospital = Hospital::where('id', auth()->user()->hospital->id)->with('departments')->first();
        $this->deps = Department::all();

        foreach ($this->deps as $department) {
            if (!$this->hospital->departments->contains($department->id)) {
                $this->newdep[] = $department;
            }
        }
        // dd($this->newdep);
        return view('livewire.admin.department.add-index', ['newdep' => $this->newdep, 'hospital' => $this->hospital, 'deps' => $this->deps]);
    }
}
