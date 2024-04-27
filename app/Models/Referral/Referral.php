<?php

namespace App\Models\Referral;

use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use App\Models\Admin\ReferralType;
use App\Models\Admin\Referrtype;
use App\Models\Admin\Statustype;
use App\Models\Admin\Type;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_number',
        'referral_date',
        'referring_hospital_id',
        'receiving_hospital_id',
        'referrtype_id',
        'statustype_id', 
        'doctor_id',
        'department_id',
        'history',
        'findings',
        'treatment',
        'reason',
        'file_path',
    ];
    

    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'card_number', 'card_number');
    }
    public function referrtype()
    {
        return $this->belongsTo(Referrtype::class);
    }
    public function statustype()
    {
        return $this->belongsTo(Statustype::class);
    }


    public function referringHospital()
    {
        return $this->belongsTo(Hospital::class, 'referring_hospital_id');
    }

    public function receivingHospital()
    {
        return $this->belongsTo(Hospital::class, 'receiving_hospital_id');
    }
}
