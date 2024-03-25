<?php

namespace App\Models\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'email',
        'status',
        'department_id',
        'hospital_id'
    ];
    

    public function user(){
        return $this->belongsTo(User::class);
    }
}
