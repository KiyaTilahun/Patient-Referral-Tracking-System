<?php

namespace App\Livewire\Hospital\Outbound;

use App\Models\Admin\Hospital;
use App\Models\Referral\Referral;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class OutboundIndex extends Component
{
    use WithPagination;
    public $hospitalid;
    public array $sortBy = ['column' => 'referral_date', 'direction' => 'asc'];
    public $search;
    public $config1;
    public $referral;
    public  $chooseddate;
// modals
public bool $myModal3=false;
    public function mount()
    {
       
        $this->config1 = [  'dateFormat' => 'Y-m-d',
                       'selected'=>'today'];
    }

    public function show($id)
    {
        // dd($id);
        
        $this->referral = Referral::where('id',$id)->with('patient')->first();
        
        $this->myModal3=true;

    
    }

    public function openpdf($fileName){

       
        $filePath = "Centers/{$fileName['file_path']}"; // Adjust the path based on your storage setup
        // dd($filePath);
        if (!Storage::disk('public')->exists($filePath)) {
            
            abort(404, 'File not found');
        }
    
 
        return Storage::download('public/'.$filePath);
        
   
    }

    #[On('resettable')]
    public function reload()
    {


        $this->reset();
        $this->render();
    }
    public function register($referral){

        // dd($referral['card_number']);
        return redirect()->route('hospital.referral', [
            'card_number' => $referral['card_number'],
            'date' => $referral['referral_date']
        ]);
        
    }
    public function render()
    {
      
       if($this->search!=null){
        $this->chooseddate=null;
       }
        $this->hospitalid = auth()->user()->hospital->id;
        // dd($this->hospitalid);
        $centers = Referral::where('referring_hospital_id', $this->hospitalid)->when($this->search, function ($query) {
            $query->where('card_number', 'LIKE', '%' . $this->search . '%');
        })->when($this->chooseddate, function ($query) {
            $query->where('referral_date',  $this->chooseddate);
        })->withAggregate('receivingHospital', 'name')->withAggregate('statustype', 'name')->withAggregate('referrtype', 'name')->withAggregate('patient', 'name')->orderBy(...array_values($this->sortBy))->paginate(20);


        $headers = [
            ['key' => 'card_number', 'label' => 'Referral Id'],
            ['key' => 'referral_date', 'label' => 'Appointment Date'],
            ['key' => 'receiving_hospital_name', 'label' => 'Referral To'],
            ['key' => 'patient_name', 'label' => 'Patient Name'],
            ['key' => 'referrtype_name', 'label' => 'Type'],
            ['key' => 'statustype_name', 'label' => 'Status'],      # <-- nested attributes

        ];



        
        return view('livewire.hospital.outbound.outbound-index', [
            'centers' => $centers, 'headers' => $headers,
            'sortBy' => $this->sortBy
        ]);
    }
}
