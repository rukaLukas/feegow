<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\EntityNotFoundException;
use App\Interfaces\Service\ServiceInterface;
use App\Exceptions\GeneralValidationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Interfaces\ControllerInterface;

/**
 * Class AbstractController
 * @package Arquitetura\Infra\Controller
 */
class ReferenceController extends Controller implements ControllerInterface
{

    /**
     * @var Request
     */
    protected $createRequest;

    /**
     * @var JsonResource
     */
    protected $resource;

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     * @var string
     */
    protected $validationName;

    public function __construct()
    {
        //
        // $this->resource = $this->getResource(); 
    }

     /**
     * @return JsonResource | String
     */
    // public function getResource()
    // {
    //     $params = Request()->query->all();
    //     if (array_key_exists('schema', $params) && $params['schema'] == 'basic') {
    //         $className = get_called_class();
    //         $className = substr($className, strrpos($className, '\\') + 1);
    //         $className = str_replace('Controller', '', $className);
    //         return 'App\\Http\\Resources\\' . $className . '\\' . $className . 'BasicResource';
    //     }

    //     return $this->resource;
    // }

    /**
     * index function
     *
     * @param Request $request
     * @param [type] ...$params
     * @return JsonResponse
     */
    public function index(Request $request, ...$params): JsonResponse
    {      
        $paginationList = $this->getPaginationList($request, array_merge($params, $request->all()));               
        if (isset($this->resource)) {            
            $resource = app()->make($this->resource, ['resource' => $paginationList]);            
            return $this->ok($resource::collection($paginationList));           
        }
        dd($paginationList);
        return $this->ok($paginationList);      
    }

    /**
     * show function
     *
     * @param string|integer $id
     * @return JsonResponse
     * @throws EntityNotFoundException
     * @throws ValidationException
     * @throws GeneralValidationException
     */
    public function show(string|int $id): JsonResponse
    {
        try {
            $entity = $this->find($id);                        
            return $this->ok(new $this->resource($entity));
        } catch (\Exception | ValidationException | GeneralValidationException $e) {
            return $this->handleException($e);
        }
    }

    /**
     * store function
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception | ValidationException | GeneralException
     */
    public function store(Request $request): JsonResponse
    {
        try {
            if ($this->createRequest) {
                $createRequest = app($this->createRequest);
                $request->validate($createRequest->rules());
            }
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }

        try {
            DB::beginTransaction();            
            $response = $this->service->save($request, $this->validationName ?? null);
            DB::commit();
            return $this->success($this->messageSuccessDefault, $response, Response::HTTP_CREATED);
        } catch (\Exception | ValidationException | GeneralException $e) {
            DB::rollBack();
            return $this->handleException($e);
        }
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return JsonResponse
     * @throws Exception | ValidationException | GeneralException
     */
    public function update(Request $request, int|string $id): JsonResponse
    {
        try {
            if (isset($this->updateRequest)) {
                $requestValidateUpdate = app($this->updateRequest);
                $request->validate($requestValidateUpdate->rules());
            }
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }

        try {
            DB::beginTransaction();
            $response = $this->service->update($request, $id, $this->validationName ?? null);
            DB::commit();
            return $this->success($this->messageSuccessDefault, $response);
        } catch (\Exception | ValidationException | GeneralException $e) {
            DB::rollBack();
            return $this->handleException($e);
        }
    }

    /**
     * destroy function
     *
     * @return JsonResponse
     * @param string|int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, string|int $id): JsonResponse
    {
        try {            
            if (isset($this->deleteRequest)) {
                $requestValidateUpdate = app($this->deleteRequest);
                $request->validate($requestValidateUpdate->rules());
            }
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }
        try {       
            $this->find($id);            
            $this->service->delete($id);

            return $this->success();
        } catch (GeneralException $e) {
            if ($e instanceof GeneralException) {
                return $this->error($this->messageErrorDefault, $e->getErrors());
            }
            if ($e instanceof \Exception) {
                 return $this->error($this->messageErrorDefault, $e->getMessage());
            }
        }
    }

    /**
     * @param string|int $id
     * @return Model
     * @throws EntityNotFoundException
     */
    protected function find(string|int $id): Model
    {
        $entity = $this->service->find($id);
        if (null === $entity) {
            throw new EntityNotFoundException($id);
        }

        return $entity;
    }

    /**
     * @param Request $request
     * @param $params
     * @return mixed
     */
    protected function getPaginationList(Request $request): mixed
    {
        return $this->service->getPaginationList($request->all());
    }

    protected function getList(Request $request): mixed
    {
        return $this->service->getList($request->all());
    }
}
