<?php
namespace App\Http\Controllers;

use App\Services\ReportService;

class ReportController extends ReferenceController
{    
    /**
     * @var RecordService
     */
    protected $service;


    public function __construct(ReportService $service)
    {        
        parent::__construct();
        $this->service = $service;
    }   

    public function unvaccinatedEmployees()
    {
        $employees = $this->service->unvaccinatedEmployees();

        return $this->ok($employees);
    }
}