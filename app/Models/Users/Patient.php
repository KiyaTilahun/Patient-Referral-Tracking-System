<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'gender',
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
    
}
