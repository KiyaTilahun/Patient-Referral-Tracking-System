<?php

namespace App\Livewire\Patient;

use App\Models\Admin\DepartmentHospital;
use App\Models\Admin\Hospital;
use App\Models\Users\Patient;
use Livewire\Component;

class PatientIndex extends Component
{
    public $departments;
    public $hospital;
    public $config1;
    public $genders;
    public $name;
    public $email;
    public $phone;
    public $gender;
    public $cardnumber;
    public $treatment;
    public $dob;
    public $validated;

    // public $name;
    public bool $openref=false;


    public function mount(){

        $this->openref;
        $this->config1 = [  'dateFormat' => 'Y/m/d',
                       'enableTime' => false,];
        $this->genders = [
            ['value' => 1, 'label' => 'Male'],
            ['value' => 0, 'label' => 'Female'],
        ];
        $this->hospital=Hospital::where('id',auth()->user()->hospital_id)->with('departments')->first();
        $this->departments=$this->hospital->departments;
    }


    public function openreferral(){

        $this->redirect('/referral/add'); 
    }

    function generateCardNumber($hospitalId) {
     
        $currentMonth = date('m');
        $currentYear = date('Y');
    
        $randomNumber = rand(1000, 9999);
        $cardNumber = 'REF' .$randomNumber.'H'.$hospitalId.'D'.$this->name  . $currentMonth . $currentYear  ;
    
        // Optionally, calculate and append a check digit using Luhn's algorithm
       
    
        return $cardNumber;
    }
   

    public function register(){
        $this->validated=$this->validate();
        $patient = Patient::create([
       
          
            'name' =>  $this->validated['name'] ,
            'gender' => $this->validated['gender'],
            'email' => $this->validated['email'],
            'phone' => '+251'.$this->validated['phone'],
            'dob' => $this->validated['dob'],
            'card_number' => $this->generateCardNumber($this->hospital->id),
            'hospital_id' =>$this->hospital->id,

            
           
        ]);
        dd($this->dob);
    }
    // validation rules 

    public function rules() 
    {

       
        
            return[
               'name'=>'required|unique:hospitals',
                'gender'=>'required',
                'email'=>'unique:patients',
                'phone'=>'required|min:9|numeric',
                'dob'=>'date_format:Y/m/d',

            ];
         
       
        

    }


    public function render()
    {
        return view('livewire.patient.patient-index');
    }
}
