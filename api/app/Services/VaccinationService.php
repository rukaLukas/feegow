<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * @param Request $request
     * @return Model
     */
    public function save(Request $request, $validationName = null): Model
    {             
        $params = $this->beforeSave($request);        
        $model = $this->repository->getModel()->updateOrCreate(
            ['employee_id' => $params['employee_id']],
            $params
        );
       
        $this->afterSave($request, $model);

        return $model;
    }
}
