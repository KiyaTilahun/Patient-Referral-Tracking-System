<?php

namespace App\Livewire\Admin\Department;

use App\Models\Admin\DepartmentService;
use App\Models\Admin\Hospital;
use App\Models\Admin\HospitalService;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class ServiceTable extends Component
{
    use Toast;
    public $editable;
    public $hospital;
    public $depser = [];
    public $slot;
    public $departmentservice;
    public $alldepser;
    public bool $updatebutton = false;

    public function mount()
    {

        $this->hospital = Hospital::where('id', auth()->user()->hospital->id)->with('departments')->first();
    }
    #[On('dep_selected')]
    public function show($dep)
    {


        $this->reset('depser');
        $this->reset('updatebutton');
        $this->editable = $dep;
        // dd($this->editable);
        $this->departmentservice = HospitalService::where('hospital_id', $this->hospital->id)->where('department_id', $this->editable['id'])->get();
        $this->alldepser = DepartmentService::where('department_id', $this->editable['id'])->get();
        foreach ($this->departmentservice as $depservice) {

            $this->depser[] = $depservice->department_service_id;
        }

        //    dd($this->alldepser);
        // dd("hello");
        // dd($this->departmentservice);






    }

    public function updatedDepser()
    {

        $this->updatebutton = true;
    }
    
    public function servicesubmit()
    {

        // dd($this->depser);
        $this->validate(
            [

                'depser' => 'required'
            ]
        );

        $departmenhospital = Hospital::where('id', $this->hospital->id)->first();
        // dd($departmenservices);

        $departmenhospital->departmentServices()->detach();
        // dd("yes");
        $departmenhospital->departmentServices()->attach($this->depser, ['department_id' => $this->editable['id']]);


        $this->departmentservice = HospitalService::where('hospital_id', $this->hospital->id)->where('department_id', $this->editable['id'])->get();

        $this->warning('Services have been updated', icon: 'o-calendar',);
    }
    public function render()
    {
        return view('livewire.admin.department.service-table');
    }
}
