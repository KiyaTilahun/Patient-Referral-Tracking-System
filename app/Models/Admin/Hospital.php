<?php

namespace App\Models\Admin;

use App\Models\Referral\Referral;
use App\Models\User;
use App\Models\Users\Liaison;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;


    public function users()
    {
        $this->hasMany(User::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function departments()
    {
        return $this->belongsToMany(Department::class)->using(
            DepartmentHospital::class
        )->withPivot('active')->withTimestamps();
    }
    public function referrals(){
        return $this->hasMany(Referral::class);
    }
    public function liaison(){
        return $this->hasOne(Liaison::class);
    }


}
