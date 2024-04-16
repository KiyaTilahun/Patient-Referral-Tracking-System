<?php

namespace App\Models;

use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
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

        $hospital = Hospital::where('id', auth()->user()->hospital_id)->first();

        $availbledep =  Department::all()->toArray();

        $qr = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));
        $day = now()->format('d/m/Y');
       
        $pdf =  Pdf::loadView('utils.generatepdf', compact('availbledep', 'qr', 'day'));
        
        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->stream("",["Attachment"=>false]);
        // }, 'name.pdf');

        return $pdf->stream('name.pdf');
    }
}
