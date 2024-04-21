<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region_id'
    ];
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function users(){
        return $this->hasManyThrough(User::class,Hospital::class);

    }
 
    
}
