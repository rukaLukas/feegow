<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{    
    protected $fillable = [
        'employee_id',
        'vaccine_id',
        'first_dose_date',
        'second_dose_date',
        'third_dose_date',
    ];

    protected $casts = [
        'first_dose_date' => 'date',
        'second_dose_date' => 'date',
        'third_dose_date' => 'date',
    ];

    // Define the relationships

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }
}
