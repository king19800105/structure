<?php

namespace Anthony\Structure\Criterias;

/**
 * Class EagerLoad
 * @package Anthony\Structure\Criterias
 */
class EagerLoad implements ICriteria
{
    protected $relations;

    public function __construct(array $relations)
    {
        $this->relations = $relations;
    }

    public function apply($entity)
    {
        return $entity->with($this->relations);   
    }
}
