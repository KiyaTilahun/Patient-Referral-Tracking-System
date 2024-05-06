<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        
            'Referred By' => $this->referringHospital->name,
            'Referred To' => $this->receivingHospital->name,
            'Referral Department' => $this->department->name??' is diagonal Referral',
            'Appointment Day' => $this->referral_date??null,
            'Referral Type'=>$this->referrtype->name,
            'Status'=>$this->statustype->name,
            'Reason'=>$this->reason,
            'Findings'=>$this->findings
            // Other referral data
        ];
    }
}
