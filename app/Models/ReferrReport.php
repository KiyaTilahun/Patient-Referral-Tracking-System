<?php

namespace App\Models;

use App\Models\Admin\Appointmentslot;
use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use App\Models\Referral\Referral;
use App\Models\Users\Patient;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        $hospital = Patient::where('card_number', $id)->first();


        // $availbledep =  Department::all()->toArray();

        $qr = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($hospital->card_number));
        $day = now()->format('d/m/Y');
       
        $pdf =  Pdf::loadView('utils.generatepdf', compact('hospital', 'qr', 'day'));
        
        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->stream("",["Attachment"=>false]);
        // }, 'name.pdf');

        return $pdf->stream('name.pdf');
    }
}
