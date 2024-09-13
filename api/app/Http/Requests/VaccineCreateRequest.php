<?php

namespace App\Http\Requests;

use App\Models\Record;
use App\Models\Vaccine;
use App\Models\TargetPublic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\TypeStatusVaccination;
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
        $validator = Validator::make(Request::all(), [          
            'name' => 'required|min:5|exists:vaccines,name',  
            'batch_number' => 'required|int|min:3',
            'expiration_date' => 'required|date|after:today'            
        ]);

        return $validator->getRules();
    }
}