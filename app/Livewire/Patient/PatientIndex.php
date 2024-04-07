<?php

namespace App\Livewire\Patient;

use App\Models\Admin\DepartmentHospital;
use App\Models\Admin\Hospital;
use Livewire\Component;

class PatientIndex extends Component
{
    public $departments;
    public $config1;
    public $genders;
    public $name;
    public $selectedgender;
    public $cardnumber;
    public $treatment;
    // public $name;
    public bool $openref=false;


    public function mount(){

        $this->openref;
        $this->config1 = ['altFormat' => 'Y/m/d'];
        $this->genders = [
            ['value' => 1, 'label' => 'Male'],
            ['value' => 0, 'label' => 'Female'],
        ];
        $hospital=Hospital::where('id',auth()->user()->hospital_id)->with('departments')->first();
        $this->departments=$hospital->departments;
    }


    public function openreferal(){

$this->openref=!$this->openref;
    }
   
    // validation rules 

    public function rules() 
    {

       
        
            return[
               'name'=>'required|unique:hospitals',
                'selectedgender'=>'required',
                'email'=>'unique:patients',
                'phone'=>'required|min:9|numeric',
                'cardnumber'=>'required',
            ];
         
       
        

    }


    public function render()
    {
        return view('livewire.patient.patient-index');
    }
}
