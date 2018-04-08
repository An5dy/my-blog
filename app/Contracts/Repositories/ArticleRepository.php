<?php

namespace App\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ArticleRepository extends RepositoryInterface
{
    /**
     * 保存或修改文章
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function createOrUpdate(array $attributes, $id = 0);
}
