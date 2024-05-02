<?php

namespace App\Models\Users;

use App\Models\Admin\Bloodtype;
use App\Models\Admin\Gender;
use App\Models\Admin\Hospital;
use App\Models\Referral\Referral;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Model
{
   
    use HasApiTokens, HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'gender_id',
        'bloodtype_id',
        'dob',
        'card_number',
        'treatment',
        'medical_history',
        'email',
        'phone',
        'address',
        'hospital_id',
        'doctor_id'
        
    ];
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
    public function referrals()
    {
        return $this->hasMany(Referral::class, 'card_number', 'card_number');
    }   
    public function gender(){
        return $this->belongsTo(Gender::class);
    }
    public function bloodtype(){
        return $this->belongsTo(Bloodtype::class);
    }
}
