<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VaccineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\VaccineCreateRequest;

class VaccineController extends ReferenceController
{
    protected $createRequest = VaccineCreateRequest::class;    

    /**
     * @var VaccineService
     */
    protected $service;


    public function __construct(VaccineService $service)
    {               
        parent::__construct();
        $this->service = $service;
    }   

     /**
     * index function
     *
     * @param Request $request
     * @param [type] ...$params
     * @return JsonResponse
     */
    public function index(Request $request, ...$params): JsonResponse
    {              
        $paginationList = $this->getPaginationList($request, array_merge($params, $request->all()));
        $cachedVaccines = Cache::remember('vaccines', now()->addHours(24),
            function () use ($paginationList) {  
                return $paginationList;
            }
        );
        return $this->ok($cachedVaccines);
    }   
}