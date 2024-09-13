<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class VaccinationCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->validate();
    }

    private function validate() {
        $validator = Validator::make(Request::all(), [          
            'employee_id' => 'required|int|exists:employees,id',
            'vaccine_id' => 'required|int|exists:vaccines,id',
            'first_dose_date' => 'nullable|date',
            'second_dose_date' => 'nullable|date',
            'third_dose_date' => 'nullable|date',                        
        ]);

        return $validator->getRules();
    }
}