<?php

use App\Http\Controllers\VaccineController;
use Illuminate\Support\Facades\Route;

Route::get('health', function () {
    return response(['ok'], 200);
});

// Route::post('employees', [AlertController::class, 'step']);

Route::apiResource('/vaccines', VaccineController::class);  