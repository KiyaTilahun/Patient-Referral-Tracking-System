<?php

namespace App\Models;

use App\Models\Admin\Hospital;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DayDepartment extends Pivot
{
    //

    protected $fillable=['day_id',
    'department_hospital_id',
    'hospital_id',
    'created_at',
    'updated_at',];

    

    public function hospital(){
        return $this->belongsTo(Hospital::class);

    }
}
