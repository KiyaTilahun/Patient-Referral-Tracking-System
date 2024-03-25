<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;



    public function hospitals()
    {
        return  $this->hasMany(Hospital::class);
    }
    public function zones()
    {

        return $this->hasMany(Zone::class);
    }
}
