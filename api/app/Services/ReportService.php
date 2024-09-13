<?php
namespace App\Services;

use App\Repositories\ReportRepository;


class ReportService extends ReferenceService
{
    /**
     * @var ReportRepository
     */
    protected $repository;

    public function __construct(ReportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function unvaccinatedEmployees()
    {       
        return $this->repository->unvaccinatedEmployees();
    }
}
