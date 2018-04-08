<?php

namespace App\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ArticleRepository extends RepositoryInterface
{
    /**
     * 保存文章及所属标签
     *
     * @param array $attributes
     * @return mixed
     */
    public function createWithTags(array $attributes);
}
