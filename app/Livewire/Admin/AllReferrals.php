<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Hospital;
use App\Models\Admin\Referrtype;
use App\Models\Admin\Region;
use App\Models\Admin\Type;
use App\Models\Referral\Referral;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;

class AllReferrals extends Component
{
    use WithPagination;
   public $hospitalid;
   public $search;
   public array $sortBy = ['column' => 'referral_date', 'direction' => 'desc'];
  public $config1;
   public $chooseddate;
   public $allhospitals;
   public $allregions;
   public $alltypes;
   public $selectedhos;
   public $selectedtype;
   public $referral;
    
   public bool $referrdetail=false;
//    pdf
public $exportreferrals;
   


public function mount(){
    $this->allhospitals = Hospital::orderBy('name', 'asc')->get();
   
    $this->alltypes=Referrtype::orderBy('name', 'asc')->get();



}


public function printpdf(){


    $this->exportreferrals=Referral::orderBy(...array_values($this->sortBy))->when($this->search, function ($query) {
        $query->where('card_number', 'LIKE', '%' . $this->search . '%');
    })->when($this->chooseddate, function ($query) {
        $query->where('referral_date',  $this->chooseddate);
    })->when($this->selectedhos, function ($query) {
        $query->where('referring_hospital_id',  $this->selectedhos);
    })->when($this->selectedtype, function ($query) {
        $query->where('referrtype_id',  $this->selectedtype);
    })->withAggregate('referringHospital', 'name')->withAggregate('statustype', 'name')->withAggregate('referrtype', 'name')->withAggregate('patient', 'name')->get(8);
    // dd($this->exportreferrals);
    $referrals=$this->exportreferrals;
    $day = now()->format('d/m/Y');
   
    $pdf =  Pdf::loadView('utils.allreferralpdf', compact('referrals','day'));

    return response()->streamDownload(function () use ($pdf) {
echo $pdf->stream();
}, 'referrals.pdf');
}
public function show($id)
{
    // dd($id);
    
    $this->referral = Referral::where('id',$id)->with('patient')->first();
    
    $this->referrdetail=true;


}
    public function render()
    {
        $this->hospitalid = auth()->user()->hospital_id;
        // dd($this->hospitalid->hosp->id);
        // $referrals = Referral::orderBy('card_number', 'asc')->paginate();
        $referrals = Referral::orderBy(...array_values($this->sortBy))->when($this->search, function ($query) {
            $query->where('card_number', 'LIKE', '%' . $this->search . '%');
        })->when($this->chooseddate, function ($query) {
            $query->where('referral_date',  $this->chooseddate);
        })->when($this->selectedhos, function ($query) {
            $query->where('referring_hospital_id',  $this->selectedhos);
        })->when($this->selectedtype, function ($query) {
            $query->where('referrtype_id',  $this->selectedtype);
        })->withAggregate('referringHospital', 'name')->withAggregate('statustype', 'name')->withAggregate('referrtype', 'name')->withAggregate('patient', 'name')->paginate(8);

        // $
        $headers = [
            ['key' => 'card_number', 'label' => 'Referral Id'],
          
            ['key' => 'referral_date', 'label' => 'Appointment Date'],
            ['key' => 'referrtype_name', 'label' => 'Type'],
            ['key' => 'statustype_name', 'label' => 'Status'],      # <-- nested attributes

        ];
        // dd($referrals);

        return view('livewire.admin.all-referrals',['referrals' => $referrals, 'headers' => $headers,
        'sortBy' => $this->sortBy]);
    }
}
