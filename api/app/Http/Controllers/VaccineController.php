<?php
namespace App\Http\Controllers;

use App\Services\VaccineService;
use App\Http\Requests\VaccineCreateRequest;

class VaccineController extends ReferenceController
{
    protected $createRequest = VaccineCreateRequest::class;
    // protected $resource = RecordResource::class;

    /**
     * @var RecordService
     */
    protected $service;


    public function __construct(VaccineService $service)
    {        
        parent::__construct();
        $this->service = $service;
    }   
}