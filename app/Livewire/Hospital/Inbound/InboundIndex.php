<?php

namespace App\Livewire\Hospital\Inbound;

use App\Models\Admin\Hospital;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class InboundIndex extends Component
{
    use WithPagination;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
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
              
    
            $centers=Hospital::where('registered','1')->when($this->search, function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%');
            })->withAggregate('region','name')->orderBy(...array_values($this->sortBy))->paginate(5);
         
    
            $headers = [
                
                ['key' => 'name', 'label' => 'Center Name'],
                ['key' => 'region_name', 'label' => 'Region Name'],
                ['key' => 'status', 'label' => 'Status'],      # <-- nested attributes
          
            ];
    
    
         
        return view('livewire.hospital.inbound.inbound-index',['centers'=>$centers,'headers'=>$headers,
        'sortBy'=> $this->sortBy]);
    }
}
