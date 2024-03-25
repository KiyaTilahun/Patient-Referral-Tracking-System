<?php

namespace App\Models\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liaison extends Model
{
    use HasFactory;

    protected $fillable = [
        'liaison_officer',
        'phone_number',
        'hospital_id'
    ];
    

    public function liaison(){
        return $this->belongsTo(Liaison::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
