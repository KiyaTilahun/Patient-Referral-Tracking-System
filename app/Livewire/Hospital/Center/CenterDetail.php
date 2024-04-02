<?php

namespace App\Livewire\Hospital\Center;

use App\Models\Admin\Hospital;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class CenterDetail extends Component
{
  

    public $detail;


    #[On('hospital_selected')]
    public function reload($id)
    {
        
        $this->detail = Hospital::findOrFail($id);
        
        $this->render();
    }



    #[On('godeactivate')]
    public function deactivation()
    {


        $this->detail->status = 0;
        $this->detail->save();
        
       
        $this->dispatch('resetdetail');
        $this->dispatch('resettable');

      

    }


    #[On('goactivate')]
    public function activation()
    {


        $this->detail->status = 1;
        $this->detail->save();
        
       
        $this->dispatch('resetdetail');
        $this->dispatch('resettable');

      

    }


    public function deactivate(){
        $this->dispatch('swal_deactivate', [
            
        ]);
        
    }

    public function activate(){
        $this->dispatch('swal_activate', [
            
        ]);
        
    }

    public function download($id)
    {
        $hos = Hospital::where('id', $id)->first();

        // dd($hos->filename);
        $path = Storage::path('public/admin/register/' . $hos->filename);

        // return response()->download($path);
    }


    public function render()
    {
        return view('livewire.hospital.center.center-detail',['detail' => $this->detail]);
    }
}
