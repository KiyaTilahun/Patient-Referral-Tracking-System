<?php

namespace App\Models\Admin;

use App\Models\Referral\Referral;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function hospitals()
    {
        return  $this->hasMany(Hospital::class);
    }
   

}
