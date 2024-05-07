<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function departments(){
        return $this->belongsToMany(Department::class)->using(
            DepartmentService::class )->withTimestamps();
     }
}
