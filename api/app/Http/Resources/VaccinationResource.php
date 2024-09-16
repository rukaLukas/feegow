<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VaccinationResource extends JsonResource
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
            'employee' => new EmployeeResource($this->employee),
            'vaccine' => $this->vaccine,
            'first_dose_date' => $this->first_dose_date,
            'second_dose_date' => $this->second_dose_date, 
            'third_dose_date'=> $this->third_dose_date
        ];
    }   
}
