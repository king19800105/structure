<?php

namespace Anthony\Structure\Filters;

use Illuminate\Support\Arr;

/**
 * 过滤基类
 * AbstractFilter class
 */
abstract class AbstractFilter implements IFilter
{
    /**
     * 别名映射
     */
    public const ALIAS_MAPPING = [];

    /**
     * 排序规则映射
     *
     * @param [type] $direction
     * @return array
     */
    protected function resolveOrderDirection($direction)
    {
        return Arr::get([
            'desc' => 'desc',
            'asc' => 'asc'
        ], $direction, 'desc');
    }
}
