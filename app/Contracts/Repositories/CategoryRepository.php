<?php

namespace App\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CategoryRepository extends RepositoryInterface
{
    public function createOrUpdate(array $attributes, $id = 0);
}
