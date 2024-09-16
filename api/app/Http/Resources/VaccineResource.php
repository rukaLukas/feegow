<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VaccineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'batch_number' => $this->batch_number,
            'expiration_date' => $this->expiration_date,                   
        ];
    }
}
