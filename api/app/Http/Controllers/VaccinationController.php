<?php
namespace App\Http\Controllers;

use App\Services\VaccinationService;
use App\Http\Resources\VaccinationResource;
use App\Http\Requests\VaccinationCreateRequest;

class VaccinationController extends ReferenceController
{
    protected $createRequest = VaccinationCreateRequest::class;
    
    /**
     * @var VaccinationService
     */
    protected $service;


    public function __construct(VaccinationService $service)
    {        
        parent::__construct();
        $this->service = $service;
    }   
}