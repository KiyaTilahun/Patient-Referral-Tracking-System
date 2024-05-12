<?php

namespace App\Livewire\Admin\Department;

use App\Models\Admin\Hospital;
use Livewire\Attributes\On;
use Livewire\Component;

class ServiceIndex extends Component
{
    public $hospital;
    public $route;

    public $selectedDepartment;

    public function mount()
    {
        $this->route = url()->previous();
        $this->hospital = Hospital::where('id', auth()->user()->hospital->id)->with('departments')->first();
    }
    public function goBack()
    {
        return redirect($this->route);
    }
    public function newdep()
    {

        $this->redirect(AddIndex::class);
    }
    public function showperm($dep)
    {

        $this->selectedDepartment = $this->hospital->departments()->findOrFail($dep);
        // dd($this->selectedDepartment);
        $this->dispatch('dep_selected', dep: $this->selectedDepartment);
    }
    
    #[On('updated')]
    public function render()
    {
        return view('livewire.admin.department.service-index');
    }
}
