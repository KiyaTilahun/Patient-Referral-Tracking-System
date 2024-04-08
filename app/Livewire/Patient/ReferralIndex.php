<?php

namespace App\Livewire\Patient;

use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ReferralIndex extends Component
{
    public $gender;
    public $card_number;
    public $name;
    public $history;
    public $finding;
    public $treatment;
    public $reason;
    public $doctor;
    public $selecteddep;
    public $doctor_id;
    public $validated;
    public $doctors;
    public $secondvalidation;
    public $totalSteps = 2;
    public $currentStep = 1;
    #[Url]
    public $search = '';
    public bool $diagonal = false;
    public $referral_type;
    public $initial;
    public $availbledep;
    public $typeinitial;

    public function mount()
    {
        $id = auth()->user()->hospital_id;
        $this->currentStep = 1;
        $this->doctors = Doctor::where('hospital_id', $id)->get();
        $typeinitial = Hospital::where('id', $id)->first();
        $this->typeinitial = $typeinitial->type_id;
        // dd($this->typeinitial);
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
                'card_number' => 'string|exists:patients',
                'name' => 'required|string',
                'history' => 'required|string',
                'finding' => 'required|string',
                'treatment' => 'required|string',
                'reason' => 'required|string',
                'doctor' => 'required|string',




            ];
        } else {
            return [
                'phone_number' => 'required|unique:liaisons|min:9|numeric',
                'liaison_officer' => 'required|string',


            ];
        }
    }
    public function updatedReferralType()
    {
        $this->reset('diagonal');
        if ($this->referral_type != '3') {


            $this->diagonal = true;
            if ($this->referral_type == '2') {

                $hospital = Hospital::where('id', auth()->user()->hospital_id)->first();
                $this->availbledep =  Department::whereHas('hospitals', function ($query) use ($hospital) {
                    $query->where('region_id', $hospital->region_id)
                        ->where('type_id', $hospital->type_id);
                })->get();
            } else {

                $hospital = Hospital::where('id', auth()->user()->hospital_id)->first();
                $this->availbledep =  Department::whereHas('hospitals', function ($query) use ($hospital) {
                    $query->where('region_id', $hospital->region_id)
                        ->where('type_id', '>', $hospital->type_id)
                        ->where('type_id', '<=', 3);
                })->get();
            }
        } else {
            $initial = Patient::where('card_number', $this->card_number)->first();
            $this->initial = $initial->hospital;
        }
    }

    #[On('card_choosed')]
    public function updatename($card_number)
    {


        $this->name = Patient::where('card_number', $card_number)->value('name');
    }


    public function fillSearchInput($value)
    {

        $this->card_number = $value;
        $this->dispatch('card_choosed', card_number: $value);
    }
    public function render()
    {
        $results = [];
        // dd($results);

        if (strlen($this->card_number) > 0) {

            $results = Patient::where('card_number', 'like', '%' . $this->card_number . '%')->pluck('card_number');
        }

        return view('livewire.patient.referral-index', compact('results'));
    }
}
