<?php

namespace App\Livewire\Hospital\Pending;

use App\Http\Controllers\EmailController;
use App\Models\Admin\Hospital;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class PendingDetail extends Component
{

    public $detail;
    public $statusshow=1;


    #[On('hospital_selected')]
    public function reload($id)
    {
        
        $this->detail = Hospital::findOrFail($id);
        
        $this->render();
    }


    #[On('gosave')]
    public function activation()
    {


        $this->detail->registered = 1;
        $this->detail->save();
        // $mailer=new EmailController();
        // $mailer->sendmail($this->detail);
       
        $this->dispatch('hospital_approved', name: $this->detail->name);
      

    }



    #[On('reset_detail')]
    public function resetdetail()
    {
    
       
        $this->reset('detail');
        session()->flash('status', ' has been approved successfully.');
        $this->render();
        

    }


    public function try_save(){
        $this->dispatch('swal_saved', [
            
        ]);
        
    }

    public function try_delete(){
      
        $this->dispatch('deletedialog', [
            
        ]);
        
    }


    #[On('godelete')]
    public function delete()
    {


       
        $this->detail->delete();
        
        $this->dispatch('deleted');
    }



   

    public function download($id)
    {
        $hos = Hospital::where('id', $id)->first();

        // dd($hos->filename);
        $path = Storage::path('public/admin/register/' . $hos->filename);

        // dd($path);
        return response()->download($path);
    }
    public function render()
    {
        return view('livewire.hospital.pending.pending-detail', ['detail' => $this->detail]);
    }
}
