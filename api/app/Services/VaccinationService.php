<?php
namespace App\Services;

use App\Repositories\VaccinationRepository;


class VaccinationService extends ReferenceService
{
    /**
     * @var VaccinationRepository
     */
    protected $repository;

    public function __construct(VaccinationRepository $repository)
    {
        $this->repository = $repository;
    }
}
