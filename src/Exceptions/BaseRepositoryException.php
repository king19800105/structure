<?php

namespace Anthony\Structure\Exceptions;

use Exception;
use Illuminate\Support\Str;

/**
 * 仓储异常父类
 * 
 * BaseRepositoryException class
 */
abstract class BaseRepositoryException extends Exception
{
    protected const LANGUAGE_FILE_NAME = 'structure';

    protected $snakeClassName;

    protected $errorCode = 0;

    public function __construct(string $message = null)
    {
        $this->coverCurrentClassNameToSnakeCase();
        $lang = static::LANGUAGE_FILE_NAME . '::' . static::LANGUAGE_FILE_NAME . '.' . $this->snakeClassName;
        $message = $message ?? __($lang);
        parent::__construct($message, $this->errorCode);
    }

    /**
     * 转换当前类名
     *
     * @return void
     */
    protected function coverCurrentClassNameToSnakeCase()
    {
        $name = Str::snake(class_basename(get_class($this)));
        $this->snakeClassName = str_replace('_exception', '', $name);
    }
}
