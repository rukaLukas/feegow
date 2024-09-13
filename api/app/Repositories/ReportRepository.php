<?php
namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\ReferenceRepository;

class ReportRepository extends ReferenceRepository
{

    /**
     * @var Model
     */
    protected $model;

    public function __construct()
    { }

    public function unvaccinatedEmployees()
    {     
        return Employee::doesntHave('vaccinations')
            ->select('cpf', 'name')
            ->get();
    }
}
