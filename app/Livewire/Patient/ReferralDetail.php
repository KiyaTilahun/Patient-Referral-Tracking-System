<?php

namespace App\Livewire\Patient;

use App\Models\Referral\Referral;
use Livewire\Component;

class ReferralDetail extends Component
{

    public $referral;
    public $card_number;
    public $date;

    public function mount($card_number,$date){
      
$this->card_number=$card_number;
$this->date=$date;


    }
    public function render()
    {
        $this->referral=Referral::where('card_number',$this->card_number)->where('referral_date',$this->date)->first();
        return view('livewire.patient.referral-detail',['referral'=>$this->referral]);
    }
}
