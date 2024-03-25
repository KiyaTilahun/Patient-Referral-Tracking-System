<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;


    public function hospitals()
    {
        return  $this->hasMany(Hospital::class);
    }
}
