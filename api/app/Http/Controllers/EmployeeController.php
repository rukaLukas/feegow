<?php
namespace App\Http\Controllers;

use App\Services\RecordService;
use App\Services\EmployeeService;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\EmployeeCreateRequest;

class EmployeeController extends ReferenceController
{
    protected $createRequest = EmployeeCreateRequest::class;
    protected $resource = EmployeeResource::class;
    
    /**
     * @var RecordService
     */
    protected $service;


    public function __construct(EmployeeService $service)
    {        
        parent::__construct();
        $this->service = $service;
    }   
}