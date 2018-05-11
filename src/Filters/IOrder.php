<?php

namespace Anthony\Structure\Filters;

/**
 * 排序操作接口
 * IOrder interface
 */
interface IOrder 
{
    public function order($entity, $direction);
}