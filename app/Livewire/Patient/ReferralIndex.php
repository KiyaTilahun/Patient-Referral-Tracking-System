<?php

namespace App\Livewire\Patient;

use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ReferralIndex extends Component
{
    public $gender;
   public $referralid;
    public $name;
    public $history;
    public $finding;
    public $treatment;
    public $reason;
    public $doctor_id;
    public $validated;
    public $doctors;
    public $secondvalidation;
    public $totalSteps = 2;
    public $currentStep = 1;
    #[Url] 
    public $search = '';

    public function mount()
    {
        $this->currentStep = 1;
        $this->doctors=Doctor::where('hospital_id',auth()->user()->hospital_id)->get();
    }

    public function increaseStep()
    {
        $this->resetErrorBag();

        if ($this->currentStep == 1) {
            $this->validated = $this->validate();
        } else {
            $this->secondvalidation = $this->validate();
        }
        $this->resetValidation();
        // $this->reset();
        $this->currentStep++;

        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }
    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function rules()
    {


        if ($this->currentStep == 1) {
            return [
                'referralid' => 'string',
                'name' => 'required|string',
                'history' => 'required|string',
                'finding' => 'required|string',
                'treatment' => 'required|string',
                'reason' => 'required|string',
                'reason' => 'required|string',


               

            ];
        } else {
            return [
                'phone_number' => 'required|unique:liaisons|min:9|numeric',
                'liaison_officer' => 'required|string',


            ];
        }
    }
    public function goback()
    {
    }

    #[On('card_choosed')]
    public function updatename($card_number)
    {

        
        $this->name = Patient::where('card_number',$card_number)->value('name');

       
        
    }

    public function fillSearchInput($value)
{
  
    $this->referralid = $value;
    $this->dispatch('card_choosed',card_number: $value);

    
}
    public function render()
    {
        $results =[];
        // dd($results);

        if (strlen($this->referralid) > 0) {

            $results = Patient::where('card_number', 'like', '%' . $this->referralid . '%')->pluck('card_number');
        }

        return view('livewire.patient.referral-index', compact('results'));
    }
}
