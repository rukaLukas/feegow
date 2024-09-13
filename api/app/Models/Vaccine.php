<?php

namespace App\Models;

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
}
