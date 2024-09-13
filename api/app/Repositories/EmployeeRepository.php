<?php
namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class EmployeeRepository extends ReferenceRepository
{

    /**
     * @var Model
     */
    protected $model;

    public function __construct(Employee $model)
    {
        $this->model = $model;
    }
}
