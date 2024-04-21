<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function hospitals()
    {
        return  $this->hasMany(Hospital::class);
    }
    public function zones()
    {

        return $this->hasMany(Zone::class);
    }

 
    public function users(){
        return $this->hasManyThrough(User::class,Hospital::class);

    }
}
