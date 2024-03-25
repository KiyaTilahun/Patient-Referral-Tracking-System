<?php

namespace App\Models\Referral;

use App\Models\Admin\Hospital;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'referring_hospital_id',
        'receiving_hospital_id',
        'referral_date',
        'reason',
        'notes',
        'appointment',
        'file_path',
        'department_id',
        'patient_id',
        'doctor_id'
    ];
    

    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }
}
