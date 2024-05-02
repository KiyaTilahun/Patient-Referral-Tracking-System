<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferralResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'referring_hospital' => $this->referringHospital->name,
            'receiving_hospital' => $this->receivingHospital->name,
            'receiving_hospital_id'=>$this->receiving_hospital_id,
            'statustype'=>$this->statustype->name,
            'referral_date'=>$this->referral_date
            // Other referral data
        ];
    }
}
