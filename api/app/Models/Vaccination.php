<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    protected $table = "vaccination_records";

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

    public function getFirstDoseDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getSecondDoseDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getThirdDoseDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
