<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\RepositoryInterface;

abstract class ReferenceRepository implements RepositoryInterface
{

    /**
     * @return Model
     */
    public function getModel(): Model
    {        
        return $this->model;
    }

    /**
     * @param null $params
     * @param array|null $with
     * @param string $orderBy
     * @return mixed
     */
    public function all($params = null, ?array $with = [], string $orderBy = 'id'): mixed
    {
        return $this->getModel()->with($with)->query($params)->orderBy($orderBy)->get();
    }

    /**
     * Retorna em forma de lista para selecte
     * @return mixed
     */
    public function list($sortBy = 'name', $pluck = 'name'): array
    {
        return $this->getModel()->all()->sortBy($sortBy)->pluck($pluck, 'uuid')->all();
    }

    /**
     * @param array $params
     * @return Model
     */
    public function save(array $params): Model
    {      
        return $this->getModel()->forceCreate($params);
    }

    /**
     * @param int|string $id
     * @param array $with
     * @return Model|null
     */
    public function find(int|string $id, array $with = []) :Model|null
    {
        return $this->getModel()->find($id);        
    }

    /**
     * Retorna o primeiro registro encontrado
     * @param array $where
     * @return mixed
     */
    public function findOneWhere(array $where): mixed
    {
        $object = $this->where($where);
        return $object->first();
    }

    /**
     * @param string|int $id
     */
    public function delete(string|int $id) :void
    {
        $entity = $this->find($id);
        $entity->delete();
    }

    /**
     * @param Model $entity
     * @param array $data
     * @return bool
     */
    public function update(Model $entity, array $data): bool
    {
        return $entity->forceFill($data)->update();
    }

    /**
     * @param array $params
     * @param string $value
     * @param null $default
     * @return mixed|null
     */
    public function getAttribute(array $params, string $value, $default = null): mixed
    {
        return (isset($params[$value])) ? $params[$value] : $default;
    }

    /**
     * @param array $params
     * @param array $with
     * @return mixed
     */
    public function getPaginationList(array $params, array $with = [], int $perPage = null)
    {
        $perPage = $params['per_page'] ?? $params['perPage'] ?? $perPage;
        if ($perPage)
            return $this->getModel()->with($with)->paginate($perPage)->withQueryString();

        return $this->getModel()->with($with)->paginate()->withQueryString();
    }
}
