<?php

namespace App\Models\Admin;

use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloodtype extends Model
{
    use HasFactory;

    public function patients(){
        return $this->hasMany(Patient::class);
    }
}
