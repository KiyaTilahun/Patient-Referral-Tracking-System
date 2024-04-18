<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointmentslot extends Model
{
    use HasFactory;
    protected $fillable=['date' ,
    'slotused',
    'hospital_id',
    'department_id'];

    public function hospital(){
        return $this->belongsTo(Hospital::class);
     }
     
    public function department(){
        return $this->belongsTo(Department::class);
     }

     public function getSlotalottedAttribute()
     {
        
         $department = $this->department()->first();
 
         
         if ($department) {
           
             $pivot = $department->hospitals()->where('hospital_id', $this->hospital_id)->first();
 
             if ($pivot) {
            
                 return $pivot->slot;
             }
         }
         
         return null;
     }


    //  public function save(array $options = [])
    //  {
    
    //      if ($this->slotused >= $this->slotalotted) {
    //          $this->availability = 'unavailable';
    //      } else {
    //          $this->availability = 'available';
    //      }
 
    //      // Call the parent save method
    //      return parent::save($options);
    //  }
}
