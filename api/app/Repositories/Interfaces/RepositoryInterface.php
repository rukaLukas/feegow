<?php
namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * @param array $params
     * @return array
     */
    // public function formatParams(array $params) :array;

    public function all($params = null, ?array $with = [], string $orderBy = 'id'): mixed;

    public function list($sortBy = 'name', $pluck = 'name'): array;

    public function save(array $params): Model;

    public function delete(string|int $id) :void;
}
