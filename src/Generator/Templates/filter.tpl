<?php

namespace {namespace}

use Anthony\Structure\Filters\{
    AbstractFilter,
    IOrder
};

class {class_name} extends AbstractFilter {sort_interface}
{
    protected function mappings()
    {
        return [

        ];
    }

    public function filter($entity, $value)
    {
        return $entity->where('{var_name}', $value);
    }

{sort_method}
}