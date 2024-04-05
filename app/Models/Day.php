<?php

namespace App\Models;

use App\Models\Admin\Department;
use App\Models\Admin\DepartmentHospital;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    protected $fillable=['name'];



    public function departmentHospitals(){
        return $this->belongsToMany(DepartmentHospital::class,'day_department','day_id','department_hospital_id')->using(
            DayDepartment::class )->withPivot(['hospital_id'])->withTimestamps();
     }
}
