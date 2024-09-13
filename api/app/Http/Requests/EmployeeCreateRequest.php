<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:255',
            'cpf' => 'required|cpf|unique:employees,cpf',
            'date_of_birth' => 'required|date',
            'comorbidities' => 'required|boolean'            
        ]);

        return $validator->getRules();
    }
}