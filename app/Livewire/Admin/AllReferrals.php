<?php

namespace App\Livewire\Admin;

use App\Models\Referral\Referral;
use Livewire\Component;

class AllReferrals extends Component
{
   

    public function render()
    {
        $referrals = Referral::orderBy('card_number', 'asc')->paginate(20);

        // dd($referrals);
        return view('livewire.admin.all-referrals');
    }
}
