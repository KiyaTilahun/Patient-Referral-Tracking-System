<?php

namespace App\Livewire\Hospital\Outbound;

use App\Models\Admin\Hospital;
use App\Models\Referral\Referral;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class OutboundIndex extends Component
{
    use WithPagination;
     public $hospitalid;
    public array $sortBy = ['column' => 'referral_date', 'direction' => 'asc'];
    public $search;
        public function show($id){
        
            $this->dispatch('hospital_selected', id: $id);
        
        }
    
    
        #[On('resettable')]
        public function reload()
        {
    
    
           $this->reset();
           $this->render();
        
        }
        public function render()
        {
              
    $this->hospitalid=auth()->user()->hospital->id;
    // dd($this->hospitalid);
            $centers=Referral::where('referring_hospital_id',$this->hospitalid)->when($this->search, function ($query) {
                $query->where('card_number', 'LIKE', '%' . $this->search . '%');
            })->withAggregate('receivingHospital','name')->withAggregate('referrtype','name')->withAggregate('patient','name')->orderBy(...array_values($this->sortBy))->paginate(5);
         
    // dd($centers);
            $headers = [
                ['key' => 'card_number', 'label' => 'Referral Id'],
                ['key' => 'referral_date', 'label' => 'Appointment Date'],
                ['key' => 'receiving_hospital_name', 'label' => 'Referral To'],
                ['key' => 'patient_name', 'label' => 'Patient Name'],
                ['key' => 'referrtype_name', 'label' => 'Type'],
                ['key' => 'status', 'label' => 'Status'],      # <-- nested attributes
          
            ];
    
    
         
        return view('livewire.hospital.outbound.outbound-index',['centers'=>$centers,'headers'=>$headers,
        'sortBy'=> $this->sortBy]);
    }
}
