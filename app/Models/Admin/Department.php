<?php

namespace App\Models\Admin;

use App\Models\Day;
use App\Models\DayDepartment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];

    
    public function hospitals(){
        return $this->belongsToMany(Hospital::class)->using(
            DepartmentHospital::class )->withPivot(['active','slot'])->withTimestamps();
     }

     
}
