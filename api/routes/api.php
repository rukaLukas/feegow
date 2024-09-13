<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\VaccineController;
use Illuminate\Support\Facades\Route;

Route::get('health', function () {
    return response(['ok'], 200);
});

Route::apiResource('/vaccines', VaccineController::class); 

Route::apiResource('/employees', EmployeeController::class); 

Route::post('/vaccinations', [VaccinationController::class, 'store']);