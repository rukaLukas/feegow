<?php
namespace App\Services;

use App\Repositories\VaccineRepository;

class VaccineService extends ReferenceService
{
    /**
     * @var VaccineRepository
     */
    protected $repository;

    public function __construct(VaccineRepository $repository)
    {        
        $this->repository = $repository;
    }
}
