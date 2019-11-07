<?php

namespace Anthony\Structure\Traits;

/**
 * Trait CacheGenerate
 * @package Anthony\Structure\Traits
 */
trait CacheGenerate
{
    /**
     * 缓存前缀
     *
     * @var string
     */
    protected $cacheKeyPrefix;

    /**
     * 缓存设置
     *
     * @var array
     */
    protected $defaultCacheSettings = [
        'enabled' => true,
        'minutes'  => 5,
    ];

    /**
     * 使用缓存来记录数据
     *
     * @param $key
     * @param callable $callableOnMiss
     * @return \Illuminate\Contracts\Cache\Repository|mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function getOrCache($key, callable $callableOnMiss)
    {
        $key = $this->cacheKeyPrefix ?? class_basename($this) . ':' . $key;
        $cacheConfig = config('structure.cache') ?? $this->defaultCacheSettings;
        if ($cacheConfig['enabled']) {
            $cache = cache();
            if ($cache->has($key)) {
                return $cache->get($key);
            }

            $data =  call_user_func($callableOnMiss);
            $cache->put($key, $data, $cacheConfig['minutes']);

            return $data;
        }

        return call_user_func($callableOnMiss);
    }
}
