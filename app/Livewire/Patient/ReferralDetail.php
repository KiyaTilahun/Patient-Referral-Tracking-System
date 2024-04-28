<?php

namespace App\Livewire\Patient;

use App\Models\Referral\Referral;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ReferralDetail extends Component
{

    public $referral;
    public $card_number;
    public $date;
    public $route;
    public $alldays;
    public $selectedday;
    public $hospitalid;


    public function mount($card_number, $date)
    {

        $this->card_number = $card_number;
        $this->date = $date;
        $this->route = url()->previous();
    }
    public function goBack()
    {
        return redirect($this->route);
    }

    public function openpdf($fileName)
    {


        $filePath = "Centers/{$fileName['file_path']}"; // Adjust the path based on your storage setup
        // dd($filePath);
        if (!Storage::disk('public')->exists($filePath)) {

            abort(404, 'File not found');
        }


        return Storage::download('public/' . $filePath);
    }
    public function render()
    {

        $this->hospitalid = auth()->user()->hospital->id;
        
        if($this->selectedday!=null){
            $this->referral = Referral::where('referring_hospital_id', $this->hospitalid)->where('card_number', $this->card_number)->where('referral_date', $this->selectedday)->first();
        }
        else{
        $this->referral = Referral::where('referring_hospital_id', $this->hospitalid)->where('card_number', $this->card_number)->where('referral_date', $this->date)->first();}
        $this->alldays = Referral::where('referring_hospital_id', $this->hospitalid)->where('card_number', $this->card_number)->pluck('referral_date');

        $patient = $this->referral->patient;

        return view('livewire.patient.referral-detail', ['referral' => $this->referral], ['patient' => $patient], ['alldays' => $this->alldays]);
    }
}
