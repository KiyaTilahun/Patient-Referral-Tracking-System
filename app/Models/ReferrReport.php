<?php

namespace App\Models;

use App\Mail\DemoEmail;
use App\Models\Admin\Appointmentslot;
use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use App\Models\Referral\Referral;
use App\Models\Users\Patient;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Browsershot\Browsershot;

class ReferrReport extends Model
{
    use HasFactory;

    public function create($id){

        // Browsershot::url('https://spatie.be/docs/browsershot/v4/usage/creating-pdfs')->save('example.pdf');


        $latestAppointment = Referral::where('card_number', $id)
        ->latest('created_at') // Order by created_at column in descending order
        ->first(); 
        $patient = Patient::where('card_number', $id)->first();


        // $availbledep =  Department::all()->toArray();

        $qr = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($latestAppointment->card_number));
        $day = now()->format('d/m/Y');
       
        $pdf =  Pdf::loadView('utils.generatepdf', compact('patient', 'qr', 'day','latestAppointment'));
        
        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->stream("",["Attachment"=>false]);
        // }, 'name.pdf');

        return $pdf->stream('name.pdf');
    }

    public function createqr($id,$token){

        // Browsershot::url('https://spatie.be/docs/browsershot/v4/usage/creating-pdfs')->save('example.pdf');


        $patient = Patient::where('card_number', $id)->first();
        // dd($id);
      $jsonData = json_encode([
            "referral_id"=>$id,
            "token"=>$token
        ]);

        // $availbledep =  Department::all()->toArray();

        $qr = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($jsonData));
        $day = now()->format('d/m/Y');
       
        $pdf =  Pdf::loadView('utils.generateqrpdf', compact('patient', 'qr', 'day','jsonData','token'));
        
        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->stream("",["Attachment"=>false]);
        // }, 'name.pdf');

        return $pdf->stream('name.pdf');
    }


    public function referralreport($id,$date){
        
        $latestAppointment = Referral::where('card_number', $id)
        ->where('referral_date',$date) // Order by created_at column in descending order
        ->first(); 
        $patient = Patient::where('card_number', $id)->first();


        // $availbledep =  Department::all()->toArray();

        $qr = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($latestAppointment->card_number));
        $day = now()->format('d/m/Y');
       
        $pdf =  Pdf::loadView('utils.generatepdf', compact('patient', 'qr', 'day','latestAppointment'));
        
        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->stream("",["Attachment"=>false]);
        // }, 'name.pdf');

        return $pdf->stream('name.pdf');
    }

    // public function demo(){
        

    //     // $jsonData = json_encode([
    //     //     "referral_id"=>"REF8700H1Dkiya052024",
    //     //     "token"=>"1|hWEn5BUnMoWy5SMkoX6jMhhr9AwRlpKT6L0VkOzM239415f4"
    //     // ]);
    //     // $qrCodeSvg = QrCode::format('svg')->size(200)->errorCorrection('H')->generate($jsonData);
    //     // $qrCodeBase64 = base64_encode($qrCodeSvg);

    //     Mail::to("kiyatilahun0@gmail.com")->send(new DemoEmail());
       
       
    // }

}
