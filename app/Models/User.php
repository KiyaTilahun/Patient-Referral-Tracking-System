<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Admin\Hospital;
use App\Models\Admin\Region;
use App\Models\Admin\Zone;
use App\Models\Users\Doctor;
use App\Models\Users\Liaison;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'hospital_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function doctors(){
        return $this->hasMany(Doctor::class);
    }
    // public function roles(){
    //     return $this->hasMany(Role::class);
    // }
    public function liaisons(){
        return $this->hasMany(Liaison::class);
    }
  
    public function region(){
        return $this->hasOneThrough(Region::class,Hospital::class);

    }
    public function hospital(){
return $this->belongsTo(Hospital::class);

    }
  
}
