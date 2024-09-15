<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    protected $fillable = [
        'name',
        'batch_number',
        'expiration_date',
    ];

    protected $casts = [
        'expiration_date' => 'date',
    ];

    public function getExpirationDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
