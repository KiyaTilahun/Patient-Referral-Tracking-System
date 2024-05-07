<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DepartmentService extends Pivot
{
    //

    protected $fillable = ['service_id', 'department_id'];
   
    public function service(){
        return $this->belongsTo(Service::class);

    }
    public function department(){
        return $this->belongsTo(Department::class);

    }
    public function hospitals(){
        // dd("hello");
        return $this->belongsToMany(Hospital::class,'hospital_service','hospital_id','department_service_id')->using(
            HospitalService::class )->withPivot(['department_id'])->withTimestamps();
     }
}
