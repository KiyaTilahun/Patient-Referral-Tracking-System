<?php

namespace App\Models\Admin;

use App\Models\Referral\Referral;
use App\Models\User;
use App\Models\Users\Liaison;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'zone',
        'woreda',
        'country',
        'email',
        'status',
        'type_id',
        'region_id',
        'filename'
    ];


    // relationship functions
    public function users()
    {
        $this->hasMany(User::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function departments()
    {
        return $this->belongsToMany(Department::class)->using(
            DepartmentHospital::class
        )->withPivot(['active','slot'])->withTimestamps();
    }
    public function referrals(){
        return $this->hasMany(Referral::class);
    }
    public function liaison(){
        return $this->hasOne(Liaison::class);
    }

    public function departmentServices(){
        return $this->belongsToMany(DepartmentService::class,'hospital_service','hospital_id','department_service_id')->using(
            HospitalService::class )->withPivot(['department_id'])->withTimestamps();
     }

    

}
