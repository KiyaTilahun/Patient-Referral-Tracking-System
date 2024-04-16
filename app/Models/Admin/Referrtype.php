<?php

namespace App\Models\Admin;

use App\Models\Referral\Referral;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referrtype extends Model
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
