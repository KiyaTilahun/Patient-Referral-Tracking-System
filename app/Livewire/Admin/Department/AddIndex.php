<?php

namespace App\Livewire\Admin\Department;

use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use Livewire\Component;
use Mary\Traits\Toast;

class AddIndex extends Component
{
   use Toast;
    // public $center_deps;
    public $hospital;
    public $deps;

    public $numberchoosed=0;
    public $departmentlist=[];




public function mount(){
    $this->hospital=Hospital::where('id',auth()->user()->id)->with('departments')->first();
    $this->deps=Department::all();
  
}

public function adddep(){
    
// dd($this->hospital->id);
$this->validate([
    'departmentlist' => ['required'],
    ]
);
    $this->hospital->departments()->attach($this->departmentlist);

    $this->success('Department added');
    
    
}
    public function render()
    {
        $this->numberchoosed=count($this->departmentlist);
        
    //     $this->dispatch('refresh-me');
        
    //    $this->dispatch('reload_select');

        return view('livewire.admin.department.add-index');
    }
}
