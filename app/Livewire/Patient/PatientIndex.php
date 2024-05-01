<?php

namespace App\Livewire\Patient;

use App\Models\Admin\Bloodtype;
use App\Models\Admin\DepartmentHospital;
use App\Models\Admin\Hospital;
use App\Models\Users\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Livewire\Component;

class PatientIndex extends Component
{
    
    public $departments;
    public $hospital;
    public bool $savedmodal=false;
    public $config1;
    public $genders;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $gender;
    public $cardnumber;
    public $treatment;
    public $dob;
    public $bloodtype;
    public $allblood;
    public $validated;
    public $copiedref;

    // public $name;
    public bool $openref=false;


    public function mount(){

        $this->openref;
        $this->allblood=Bloodtype::all();
        $minDate = Carbon::now()->yesterday()->format('Y/m/d');
        $this->config1 = [  'dateFormat' => 'Y/m/d',
        'maxDate' =>$minDate ,
                       'enableTime' => false,];
        $this->genders = [
            ['value' => 1, 'label' => 'Male'],
            ['value' => 2, 'label' => 'Female'],
        ];
        $this->hospital=Hospital::where('id',auth()->user()->hospital_id)->with('departments')->first();
        $this->departments=$this->hospital->departments;
    }
    public function updated($name)
{
    $this->resetValidation();
}


    public function openreferral(){

        $this->redirect('/referral/add'); 
    }

    function generateCardNumber($hospitalId) {
     
        $currentMonth = date('m');
        $currentYear = date('Y');
    
        $randomNumber = rand(1000, 9999);
        $cardNumber = 'REF' . $randomNumber . 'H' . $hospitalId . 'D' . str_replace(' ', '', $this->firstname) . $currentMonth . $currentYear;

    
        // Optionally, calculate and append a check digit using Luhn's algorithm
       
    
        return $cardNumber;
    }
   

    public function register(){
        $this->validated=$this->validate();
        // dd($this->validated['gender']);
        $patient = Patient::create([
       
          
            'name' =>  $this->validated['firstname'].' '.$this->validated['lastname'] ,
            'gender_id' => $this->validated['gender'],
            'email' => $this->validated['email'],
            'bloodtype_id' => $this->bloodtype??null,
            'phone' => '+251'.$this->validated['phone'],
            'dob' => $this->validated['dob'],
            'card_number' => $this->generateCardNumber($this->hospital->id),
            'hospital_id' =>$this->hospital->id,

            
           
        ]);
        $token = $patient->createToken('authpatient');
       dd($token->plainTextToken);

        $this->copiedref= $this->generateCardNumber($this->hospital->id);
        $this->savedmodal=true;


        $this->resetValidation();

        // Clear form fields
        $this->reset([
            'firstname',
            'lastname',
            'gender',
            'email',
            'phone',
            'dob',
            'bloodtype'
        ]);

        
        
       
    }
    // validation rules 

    public function rules() 
    {

       
        
            return[
               'firstname'=>'required|regex:/^[a-zA-Z]+(?:\'[a-zA-Z]+)*$/|string',
               'lastname'=>'required|regex:/^[a-zA-Z]+(?:\'[a-zA-Z]+)*$/|string',
                'gender'=>'required',
                'email'=>'unique:patients',
                'phone'=>'required|min:9|numeric',
                'dob'=>'date_format:Y/m/d|before_or_equal:yesterday',

            ];
         
       
        

    }


    public function render()
    {
        return view('livewire.patient.patient-index');
    }
}
