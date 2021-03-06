<?php

namespace Anthony\Structure\Criterias;

/**
 * Class ByCreateTime
 * @package App\Structure\Criterias
 */
class ByCreateTime implements ICriteria
{
    public function apply($entity)
    {
        return $entity->latest();
    }
}
