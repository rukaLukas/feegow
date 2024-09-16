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
            'employee_id' => 'required|integer|exists:employees,id',
            'vaccine_id' => 'required|integer|exists:vaccines,id',
            'first_dose_date' => 'required|date',
            'second_dose_date' => 'nullable|date|after:first_dose_date',
            'third_dose_date' => 'nullable|date|after:second_dose_date',
        ]);

        return $validator->getRules();
    }

    public function messages()
    {
        return [         
            'second_dose_date.after' => 'A data da segunda dose deve ser após a data da primeira dose.',
            'third_dose_date.after' => 'A data da terceira dose deve ser após a data da segunda dose.',
        ];
    }
}