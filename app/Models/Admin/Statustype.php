<?php

namespace App\Models\Admin;

use App\Models\Referral\Referral;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statustype extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function referrals()
    {
        return $this->hasMany(Referral::class);
    }
}
