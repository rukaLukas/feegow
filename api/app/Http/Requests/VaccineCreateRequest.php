<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class VaccineCreateRequest extends FormRequest
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
        $applyExistsRule = DB::table('vaccines')->count() === 0 ? '' : 'exists:vaccines,name';
        $validator = Validator::make(Request::all(), [          
            'name' => 'required|min:5|' . $applyExistsRule,  
            'batch_number' => 'required|numeric|min:3',
            'expiration_date' => 'required|date|after:today'            
        ]);

        return $validator->getRules();
    }
}