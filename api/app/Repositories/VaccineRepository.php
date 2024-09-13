<?php
namespace App\Repositories;

use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\ReferenceRepository;

class VaccineRepository extends ReferenceRepository
{

    /**
     * @var Model
     */
    protected $model;

    public function __construct(Vaccine $model)
    {        
        $this->model = $model;
    }
}
