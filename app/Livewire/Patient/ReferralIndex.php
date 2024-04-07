<?php

namespace App\Livewire\Patient;

use Livewire\Component;

class ReferralIndex extends Component
{
    public $gender;

    public function goback(){


    }
    public function render()
    {
        return view('livewire.patient.referral-index');
    }
}
