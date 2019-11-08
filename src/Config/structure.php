<?php
/*
|--------------------------------------------------------------------------
| Repository Config
|--------------------------------------------------------------------------
|
|
*/
return [
    /**
     * 默认分页
     */
    'pagination' => [
        'limit' => 20
    ],
    /**
     * 数据缓存设置
     */
    'cache'      => [
        'enabled' => true,
        'second'  => 10,
    ],
    /**
     * 排序设置
     */
    'order'      => [
        'type'  => 'o',
        'field' => 'orderable',
    ],
    /**
     * 文件自动生成器
     */
    'generator'  => [
        'root_namespace' => 'App\\',
        'namespace'      => [
            'controller'          => '',
            'repository_eloquent' => 'Repositories\\Eloquent',
            'repository'          => 'Repositories\\Contracts',
            'criteria'            => 'Repositories\\Criterias',
            'provider'            => 'Providers\\StructureServiceProvider',
            'service'             => 'Services',
            'model'               => 'Models',
            'response'            => 'Http\\Responders',
            'filter'              => 'Repositories\\Filters'
        ]
    ]
];
