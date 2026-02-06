<?php

namespace PhpCsv\Facade;

use PhpCsv\Csv\Csv as CsvDriver;

/**
 * CSV类的门面类型
 * @mixin \PhpCsv\Csv\Csv
 */
class Csv extends Facade
{
    // 提供访问器对应的具体类
    protected static function accessor(): string
    {
        return CsvDriver::class;
    }
    
}
