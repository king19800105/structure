<?php

namespace Anthony\Structure\Traits;

use Anthony\Structure\Exceptions\IllegalFilterInstanceException;
use Anthony\Structure\Filters\{
    IFilter,
    IOrder
};

/**
 * 过滤操作挂件
 * FilterTrait trait
 */
trait FilterTrait
{
    /**
     * 设置过滤的模型
     *
     * @var array
     */
    protected $filterList = [];

    /**
     * 过滤配置列表
     *
     * @var array
     */
    protected $orderConfigs;

    /**
     * entity数据操作对象
     *
     * @var
     */
    protected $entity;

    /**
     * 别名映射
     *
     * @var array
     */
    protected $mapping;

    /**
     * 初始化数据
     *
     * @param [type] $entity
     * @param [type] $filterList
     * @return $this
     */
    public function init($entity, $filterList)
    {
        $request = request();
        //获取path params 合并到request里面
        $request->merge($request->route()->parameters());
        $this->orderConfigs = config('structure.order');
        $this->entity       = $entity;
        $this->filterList   = $filterList;
        $this->mapping      = $this->getFieldMapping();

        return $this;
    }

    /**
     * 获取查询的键值对数据
     *
     * @return array
     */
    protected function getSearchable()
    {
        $result     = [];
        $request    = request();
        $filterKeys = array_keys($this->filterList);
        if (empty($this->mapping)) {
            return array_filter(
                $request->only($filterKeys)
            );
        }

        foreach ($this->mapping as $key => $item) {
            if ($request->exists($key) && in_array($item, $filterKeys)) {
                $result[$item] = $request->input($key);
            }
        }

        return array_filter(array_merge($request->only($filterKeys), $result));
    }

    /**
     * 执行过滤操作
     *
     * @return $this
     * @throws \Throwable
     */
    public function doFilter()
    {
        foreach ($this->getSearchable() as $key => $item) {
            $this->entity = $this->resolveFilter($key)->filter($this->entity, $item);
        }

        return $this;
    }

    /**
     * 获取排序的键值对数据
     *
     * @return array
     */
    protected function getOrderable()
    {
        $list = array_filter(
            request()->only([$this->orderConfigs['field'], $this->orderConfigs['type']])
        );

        return count($list) === count($this->orderConfigs) ? $list : [];
    }

    /**
     * 执行单字段排序操作
     *
     * @return $this
     * @throws \Throwable
     */
    public function doOrder()
    {
        $orderInfo = $this->getOrderable();
        if (!empty($orderInfo)) {
            $key  = $orderInfo[$this->orderConfigs['field']];
            $type = $orderInfo[$this->orderConfigs['type']];
            if (!empty($this->mapping) && array_key_exists($key, $this->mapping)) {
                $key = $this->mapping[$key];
            }

            $this->entity = $this->resolveOrder($key)->order($this->entity, $type);
        }

        return $this;
    }


    /**
     * 获取实例对象
     *
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * 实例化filter对象
     *
     * @param $filterName
     *
     * @return mixed
     * @throws \Throwable
     */
    protected function resolveFilter($filterName)
    {
        $filter = new $this->filters[$filterName]();
        throw_if(
            !$filter instanceof IFilter,
            new IllegalFilterInstanceException()
        );

        return $filter;
    }

    /**
     * 实例化order对象
     *
     * @param $orderName
     *
     * @return mixed
     * @throws \Throwable
     */
    protected function resolveOrder($orderName)
    {
        $order = new $this->filters[$orderName];
        throw_if(
            !$order instanceof IOrder,
            new IllegalFilterInstanceException()
        );

        return $order;
    }

    /**
     * 获取映射列表
     *
     * @return array
     */
    protected function getFieldMapping()
    {
        $result = [];
        foreach ($this->filterList as $item) {
            if ($mapping = constant($item . '::ALIAS_MAPPING')) {
                $result = array_merge($result, $mapping);
            }
        }

        return $result;
    }
}
