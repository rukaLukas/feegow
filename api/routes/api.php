<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\VaccinationController;

Route::get('health', function () {
    return response('', 200);
});

Route::apiResource('/vaccines', VaccineController::class); 

Route::apiResource('/employees', EmployeeController::class); 

Route::apiResource('/vaccinations', VaccinationController::class);

Route::get('/reports/unvaccinatedEmployees', [ReportController::class, 'unvaccinatedEmployees']);