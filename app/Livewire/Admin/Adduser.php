<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\EmailController;
use App\Mail\RegisterEmail;
use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use App\Models\User;
use App\Models\Users\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Mary\Traits\Toast;

class Adduser extends Component
{
use Toast;

public $holder;
public $hospital;
    public $firstname;
    public $lastname;

    public $phone;
    public $email;
    public $type;
    public $dep;
    public $role;
 public $rolesnot=['superadmin'];
 public bool $isdoctor=false;
 




 public function updatedRole($role_name)
 {
    $this->resetValidation();
    if($role_name=='doctor'){
       
      
    $this->isdoctor=true;}
    else{
        $this->isdoctor=false;
    }
 }

public function register(){
   $validated= $this->validate();
if($this->role=='doctor'){
     $doctor = Doctor::create([
       
          
        'name' =>   $this->firstname.' '.$this->lastname,
        'email' =>  $this->email,
        'phone' => $this->phone,
        'department_id' => $this->dep,
        'status'=>true,
        'hospital_id'=>$this->hospital->id

        
     ]);
     $mailer=new EmailController();
        $mailer->sendmaildoctor($doctor);
    }
    else{
        $password=Str::random(10);
       
       $user=User::create(
        ['name'=>$validated['firstname'].' '.$validated['lastname'],'email'=>$validated['email'],'email_verified_at'=> now(),'hospital_id'=>$this->hospital->id,'password'=>Hash::make($password)]
       );
       
       if($this->role=='admin'){
        $user=$user->assignRole('admin');
       }
       else{
        $user=$user->assignRole('staff');
       }
     $user->save();
      //  $response=Mail::to($user->email)->send(new RegisterEmail($user->email,$password));
       $message=[];
       try {
        
         Mail::to($user->email)->send(new RegisterEmail($user->email, $password));
         $this->success("User name and Password sent via email");

         $message[]=["status"=>true];

     } catch (\Exception $e) {
     
         // Return a failure response
         $message[]=["status"=>false];
         $this->error("Error, Email is not sent");

     }

     
      

    }
    
}

 public function rules() 
 {

    
       if($this->isdoctor){
         return[
            'firstname'=>'required|regex:/^[a-zA-Z]+(?:\'[a-zA-Z]+)*$/|string',
            'lastname'=>'required|regex:/^[a-zA-Z]+(?:\'[a-zA-Z]+)*$/|string',
             'email'=>'required|unique:users',
             'phone'=>'required|min:9|numeric',
             'role'=>'required',
             'dep'=>'required',

       
       ];}
       else{
         return[
            'firstname'=>'required|regex:/^[a-zA-Z]+(?:\'[a-zA-Z]+)*$/|string',
            'lastname'=>'required|regex:/^[a-zA-Z]+(?:\'[a-zA-Z]+)*$/|string',
            'email'=>'required|unique:users',
            'phone'=>'required|min:9|numeric',
            'role'=>'required',
          

       
       ];}
     
    
     

 }






    public function render()
    {


        $this->hospital=Hospital::where('id',auth()->user()->hospital->id)->first();
        $roles=Role::whereNotIn('name', $this->rolesnot)->get();
        return view('livewire.admin.adduser',['hospital'=>$this->hospital,'roles'=>$roles]);
    }
}
