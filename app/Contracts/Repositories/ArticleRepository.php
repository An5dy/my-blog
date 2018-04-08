<?php

namespace App\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ArticleRepository extends RepositoryInterface
{
    /**
     * 保存或修改文章及所属标签
     *
     * @param array $attributes
     * @param array $tags
     * @param int $id
     * @return mixed
     */
    public function createOrUpdateWithTags(array $attributes, array $tags, $id = 0);
}
