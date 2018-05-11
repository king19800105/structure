# 项目架构包

## 安装

### 使用要求

- laravel >= 5.5    
- php     >= 7.1

### composer
执行以下命令获取包的最新版本:

```php
    composer require anthony\structure
```

### laravel

#### 生成配置文件
```php
    php artisan vendor:publish --provider "Anthony\Structure\Providers\StructureServiceProvider"
```

#### 注册到服务容器

说明：用命令生成仓储文件时(anthony:entity || anthony:repository)，会自动生成StructureServiceProvider文件。

```php
    # 在config/app.php中
    'providers' => [
        // ......
        App\Providers\StructureServiceProvider::class,
    ];
```