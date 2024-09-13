<?php
namespace App\Services;

use App\Repositories\EmployeeRepository;


class EmployeeService extends ReferenceService
{
    /**
     * @var EmployeeRepository
     */
    protected $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }
}
