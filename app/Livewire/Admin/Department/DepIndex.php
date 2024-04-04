<?php

namespace App\Livewire\Admin\Department;

use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use Carbon\Carbon;
use Livewire\Component;

class DepIndex extends Component
{

   
public $hospital;


public $selectedDepartment;

public function mount(){
    $this->hospital=Hospital::where('id',auth()->user()->id)->with('departments')->first();
    
}


public function showperm($dep){
    
    $this->selectedDepartment = $this->hospital->departments()->findOrFail($dep);
    // dd($this->selectedDepartment);
    $this->dispatch('dep_selected', dep: $this->selectedDepartment);

}


// public function showperm($department){

//     $this->choosed=Department::where('id',$department)->first()->name;
//      $this->choosed=$department;
//    $this->isselected=true;
    // $startDate = Carbon::now()->startOfDay();
    // $endDate = $startDate->copy()->addDays(5);

  


   
    //         $date = $startDate->copy(); // Clone $startDate to avoid modifying it directly
    //         while ($date->lte($endDate)) {
    //             if ($date->dayOfWeek != Carbon::SATURDAY && $date->dayOfWeek != Carbon::SUNDAY) {
    //                 AppointmentSlot::create([
    //                     'department_id' => $department,
    //                     'date' => $date->toDateString(), // Convert to string to avoid object passing
    //                     'hospital_id' => $this->hospital->id,
    //                 ]);
    //             }
    //             $date->addDay(); // Move to the next day
    //         }
    
// }



// this is to add new department

public function newdep(){

    $this->redirect(AddIndex::class);
}
    public function render()
    {
       

        return view('livewire.admin.department.dep-index');
    }
}
