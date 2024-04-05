<?php

namespace App\Models\Admin;

use App\Models\Day;
use App\Models\DayDepartment;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DepartmentHospital extends Pivot
{
    //

    protected $fillable=['active','slot'];

    public function days(){
        return $this->belongsToMany(Day::class,'day_department','department_hospital_id','day_id')->using(
            DayDepartment::class )->withPivot(['hospital_id'])->withTimestamps();
     }
}
