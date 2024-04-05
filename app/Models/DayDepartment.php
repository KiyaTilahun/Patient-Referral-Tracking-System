<?php

namespace App\Models;

use App\Models\Admin\Hospital;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DayDepartment extends Pivot
{
    //

    protected $fillable=['hospital_id'];

    

    public function hospital(){
        return $this->belongsTo(Hospital::class);

    }
}
