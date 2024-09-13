<?php
namespace App\Repositories;

use App\Models\Vaccination;
use Illuminate\Database\Eloquent\Model;

class VaccinationRepository extends ReferenceRepository
{

    /**
     * @var Model
     */
    protected $model;

    public function __construct(Vaccination $model)
    {
        $this->model = $model;
    }
}
