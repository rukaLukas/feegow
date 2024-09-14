<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf',
        'name',
        'date_of_birth',
        'comorbidities',
    ];

    protected $casts = [
        'date_of_birth' => 'date:Y-m-d',
        'comorbidities' => 'boolean',
    ];

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class, 'employee_id');
    }

    public function getDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
