<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

    public function afterSave(Request $request, mixed $model): void
    {
        Cache::forget('vaccines');
    }
}
