<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Get all models.
     *
     * @param array $relations
     * @param array $filters
     * @param array $sort
     */
    public function all(array $relations = [], array $filters = [], array $sort = []);

    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): ?Model;

}
