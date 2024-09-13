<?php
namespace App\Repositories;

use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Model;

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

    // public function formatParams(array $params): array
    // {
    //     return [
    //         'name' => $this->getAttribute($params, 'name'),
    //         'schema' => $this->getAttribute($params, 'schema'),
    //         'dose' => $this->getAttribute($params, 'dose'),
    //         'aplication_age_month' => $this->getAttribute($params, 'aplication_age_month'),
    //         'limit_age_year' => $this->getAttribute($params, 'limit_age_year'),
    //     ];
    // }
}
