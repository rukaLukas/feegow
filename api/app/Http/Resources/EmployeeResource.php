<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'cpf' => $this->maskCpf($this->cpf),
            'date_of_birth' => $this->date_of_birth,
            'comorbidities' => $this->comorbidities ? 'Sim' : 'Não'       
        ];
    }

    private function maskCpf($cpf)
    {
        return substr($cpf, 0, 3) . '.###.###-##';
    }
}
