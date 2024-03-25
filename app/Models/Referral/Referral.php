<?php

namespace App\Models\Referral;

use App\Models\Admin\Hospital;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }
}
