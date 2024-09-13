<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'date_of_birth' => 'date',
        'comorbidities' => 'boolean',
    ];

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class, 'employee_id');
    }
}
