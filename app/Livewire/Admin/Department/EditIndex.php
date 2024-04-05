<?php

namespace App\Livewire\Admin\Department;

use App\Models\Admin\Department;
use App\Models\Admin\DepartmentHospital;
use App\Models\Admin\Hospital;
use App\Models\Day;
use App\Models\DayDepartment;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class EditIndex extends Component
{
    public $editable;
    public $hospital;
    public $depdays = [];
    public $slot;
    public $department;

    public function mount()
    {

        $this->hospital = Hospital::where('id', auth()->user()->id)->with('departments')->first();
    }
    #[On('dep_selected')]
    public function show($dep)
    {

      
        $this->reset('depdays');
        $this->editable = $dep;
        // dd(DayDepartment::all());
        $this->department = DepartmentHospital::where('hospital_id', $this->hospital->id)->where('department_id', $this->editable['id'])->first();
       
        $departmentDays = DayDepartment::where('hospital_id', $this->hospital->id)->where('department_hospital_id', $this->department->id)->get();

      
        $this->slot=$this->department->slot;

     

        foreach($departmentDays as $dep ){

             $this->depdays[]= $dep->day_id;

        }

      


    }

    public function adddays()
    {

    

        $this->validate(
            [
                'slot' => ['required'],
                'depdays'=>['required']
            ]
        );

      $this->department->update(['slot'=>$this->slot]);
        

        $departmentDays = DepartmentHospital::where('hospital_id', $this->hospital->id)->where('department_id', $this->editable['id'])->first();
       

        // dd(DayDepartment::all());
        $departmentDays->days()->detach();
        $departmentDays->days()->attach($this->depdays, ['hospital_id' => $this->hospital->id]);

        $this->reset('depdays');
        $this->reset('slot');
        $this->render();
    }


    public function messages() 
    {
        return [
            'depdays.required' => 'One day atleast must be choosen',
      
        ];
    }
    public function render()
    {

        $days = Day::all();


        return view('livewire.admin.department.edit-index', ['days' => $days]);
    }
}
