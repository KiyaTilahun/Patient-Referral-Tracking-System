<?php

namespace App\Livewire\Hospital\Center;

use App\Models\Admin\Hospital;
use App\Models\Admin\Region;
use App\Models\Admin\Type;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CenterTable extends Component
{

use WithPagination;

public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
public $search;
public $selectedregion;
public $selectedtype;
public $allregions;
public $alltypes;
public $exportcenters;

public function mount(){
    $this->allregions=Region::all();
    $this->alltypes=Type::all();
}

    public function show($id){
    
        $this->dispatch('hospital_selected', id: $id);
    
    }


    #[On('resettable')]
    public function reload()
    {


       $this->reset();
       $this->render();
    
    }

    public function printpdf(){


        $this->exportcenters=Hospital::where('registered','1')->when($this->search, function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        })->when($this->selectedregion, function ($query) {
            $query->where('region_id',$this->selectedregion);
        })->when($this->selectedtype, function ($query) {
            $query->where('type_id',$this->selectedtype);
        })->withAggregate('region','name')->orderBy(...array_values($this->sortBy))->get();
        // dd($this->exportcenters);
        $centers=$this->exportcenters;
        $day = now()->format('d/m/Y');
       
        $pdf =  Pdf::loadView('utils.centerspdf', compact('centers','day'));

        return response()->streamDownload(function () use ($pdf) {
echo $pdf->stream();
}, 'centers.pdf');
    }

    
    public function render()
    {
          

        $centers=Hospital::where('registered','1')->when($this->search, function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        })->when($this->selectedregion, function ($query) {
            $query->where('region_id',$this->selectedregion);
        })->when($this->selectedtype, function ($query) {
            $query->where('type_id',$this->selectedtype);
        })->withAggregate('region','name')->orderBy(...array_values($this->sortBy))->paginate(5);


   

        $headers = [
            
            ['key' => 'name', 'label' => 'Center Name'],
            ['key' => 'region_name', 'label' => 'Region Name'],
            ['key' => 'status', 'label' => 'Status'],      # <-- nested attributes
      
        ];


        return view('livewire.hospital.center.center-table',['centers'=>$centers,'headers'=>$headers,
        'sortBy'=> $this->sortBy]);
    }
}
