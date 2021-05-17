<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $relations
     * @param array $filters
     * @param array $sort

     */
    public function all(array $relations = [], array $filters = [], array $sort = [])
    {
        $model = $this->model->with($relations);

        foreach($filters as $key => $value){
            $model->where($key, $value);
        }

        foreach($sort as $key => $value){
            $model->sortBy($key, $value);
        }

        return $model->paginate();
    }


    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }

}
