<?php

namespace Anthony\Structure\Filters;

/**
 * 过滤操作接口
 * IFilter interface
 */
interface IFilter 
{
    public function filter($entity, $value);
}