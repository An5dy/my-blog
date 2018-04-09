<?php

namespace App\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ThoughtRepository.
 *
 * @package namespace App\Contracts\Repositories;
 */
interface ThoughtRepository extends RepositoryInterface
{
    public function createOrUpdate(array $attributes, $id = 0);
}
