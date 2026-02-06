<?php

namespace PhpCsv\Facade;

use PhpCsv\Exception\FacadeException;
use PhpCsv\Exception\NotExists;

/**
 * 门面抽象类实现
 * @class Facade
 * @description 门面抽象类型
 */
abstract class Facade
{
    // 抽象访问器【门面主要依赖】
    protected abstract static function accessor() : string;
    
    // 静态调用处理
    public static function __callStatic($name, $arguments)
    {
        $class = static::accessor();

        if (!class_exists($class)) {
            throw new NotExists("class $class Not Found!", 404);
        }
        $obj = new $class();

        $ref = new \ReflectionMethod($obj, $name);
        if (!$ref->isPublic()) {
            // 不能调用
            throw new FacadeException("method $class::$name not found!", 404);
        }
        
        return $obj->$name(...$arguments);
    }

}
