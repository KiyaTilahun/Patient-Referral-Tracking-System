<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\SmsController;
use App\Models\Users\Patient;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class AllPatients extends Component
{
    use Toast,WithPagination;
    public $search;
   public array $sortBy = ['column' => 'card_number', 'direction' => 'desc'];
   public $hospitalid;
   public bool $patientdetail=false;
   public bool $emailstatus=false;
   public bool $smsstatus=false;
   public bool $patienteditmodal=false;
   public bool $updatedinfo=false;

   public $name;
   public $phone;
   public $email;



   




   public $indvidualpatient;

   public function mount(){

    $this->hospitalid = auth()->user()->hospital->id;
   }
    public function updated($newdepartment)
    {
        $this->updatedinfo=true;
    }
   public function show($id)
{
    // dd($id);
    $this->emailstatus=false;
    $this->smsstatus=false;
    $this->indvidualpatient = Patient::where('id',$id)->with('gender')->first();
    
    $this->patientdetail=true;


}
// edit patient
public function edit($id)
{
    $this->updatedinfo=false;

    $this->indvidualpatient = Patient::where('id',$id)->with('gender')->first();
    $this->name= $this->indvidualpatient->name;
    $this->phone= $this->indvidualpatient->phone;
    $this->email= $this->indvidualpatient->email;


        $this->patienteditmodal = true;
   
    // dd($this->selecteddep);
}

public function patientupdate(){
    $validatedData = $this->validate([
        'name' => 'required',
        'email'=>'email|required',
        'phone'=>'required|min:9|numeric',

    ]);
   
    $this->indvidualpatient->update($validatedData);
$this->patienteditmodal=false;
$this->success("patient updated successfully");
}

   // sms sending logic 
   public function smssend(){
    $token = $this->indvidualpatient->createToken('authpatient');
    $tokentext=$token->plainTextToken;
    $sender = new SmsController();
    $message = "Referral Id: " . $this->indvidualpatient->card_number . " Unique Id: " .$tokentext ;
    // $message="hellp";
    $checkresponse=$sender->patientsms($this->indvidualpatient->name,$this->indvidualpatient->phone,$message);
      if($checkresponse['success']==true){
   $this->smsstatus=true;
      }
      else{
$this->error($checkresponse["message"]);
      }
}
// email
public function emailsend(){

    if($this->indvidualpatient->email!=null){
        $token = $this->indvidualpatient->createToken('authpatient');
        $tokentext=$token->plainTextToken;
 $mailer=new EmailController();
$response=$mailer->sendpatientmail($this->indvidualpatient->card_number,$tokentext,$this->indvidualpatient->email);
if ($response['status'] == 'success') {
 $this->emailstatus=true;
 ; 
} else {
 $this->error($response['message']); 
}
}
}
    public function render()
    {
        $patients = Patient::where('hospital_id',$this->hospitalid)->when($this->search, function ($query) {
            $query->where('card_number', 'LIKE', '%' . $this->search . '%');
        })->withAggregate('gender', 'name')->paginate(8);

        $headers = [
            ['key' => 'card_number', 'label' => 'Referral Id'],
          
            ['key' => 'name', 'label' => 'Patient Name'],
            ['key' => 'gender_name', 'label' => 'Gender'],
            ['key' => 'phone', 'label' => 'Phone'],      # <-- nested attributes

        ];
        return view('livewire.admin.all-patients',['patients' => $patients, 'headers' => $headers,
        'sortBy' => $this->sortBy]);
    }
}
