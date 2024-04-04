<?php

namespace App\Livewire\Admin\Department;

use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class EditIndex extends Component
{
public $editable;
public $hospital;

public $slot;

    #[On('dep_selected')]
public function show($dep){

  

   $this->editable=$dep;
   
    // dd($this->editable['pivot']['slot']);



  
        
    $this->render();
}
    public function render()
    {
        $alldays = Carbon::getDays(); 

     
        
        foreach ($alldays as $value) {
          
            if ($value == 'Sunday') {
             continue;
            }
          $days[] = $value;
        }
        return view('livewire.admin.department.edit-index',['days'=>$days]);
    }
}
