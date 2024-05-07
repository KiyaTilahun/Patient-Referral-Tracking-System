<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Relations\Pivot;

class HospitalService extends Pivot
{

    //
    
    protected $fillable=[
    'department_service_id',
    'hospital_id',
    'department_id'
    
    ];


    public function hospital(){
        return $this->belongsTo(Hospital::class);

    }
    public function department(){
        return $this->belongsTo(Department::class);

    }
    public function departmentService(){
        return $this->belongsTo(DepartmentService::class);
    }

    
   

  
}

