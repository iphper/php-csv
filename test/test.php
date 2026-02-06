<?php

include_once __DIR__ . '/../vendor/autoload.php';

use PhpCsv\Csv\Csv;

$csv = new Csv();

# 一、读取

// 1、读取
// 普通读取
$data = $csv->read(__DIR__.'/data/example.csv');
var_dump($data);

// 或者
$data = $csv->filename(__DIR__.'/data/example.csv')->read();
var_dump($data);

// 2、回调式读取【每行回调】
$csv->filename(__DIR__.'/data/example.csv')->readFn(fn($row) => var_dump($row));

// 3、格式化读取
$data = $csv->formats([
        // 列索引 => 格式化回调|常量
        '0' => fn($name) => "名称:$name",
        '2' => "计应1班"
    ])
    ->format('1', fn($no) => ":$no")
    ->read(__DIR__.'/data/example.csv');
var_dump($data);

// 4、使用门面模式读取
$data = PhpCsv\Facade\Csv::read(__DIR__.'/data/example.csv');
var_dump($data);

// 或
$data = PhpCsv\Facade\Csv::filename(__DIR__.'/data/example.csv')->read();
var_dump($data);


// 5、门面式回调式读取【每行回调】
PhpCsv\Facade\Csv::filename(__DIR__.'/data/example.csv')->readFn(fn($row) => var_dump($row));

// 6、格式化式读取
$data = PhpCsv\Facade\Csv::formats([
        // 列索引 => 格式化回调|常量
        '0' => fn($name) => "名称:$name",
        '2' => "计应1班"
    ])
    ->format('1', fn($no) => ":$no")
    ->read(__DIR__.'/data/example.csv');
var_dump($data);


# 二、写入

// 1、写入
$data = [
    ['name' => '名称', 'no' => '学号', 'class' => '班级'], // 行
    ['name' => '陈一', 'no' => '26010001', 'class' => '计算机应用技术1班'], // 行
    ['name' => '邓二', 'no' => '26010002', 'class' => '计算机应用技术1班'], // 行
    ['name' => '张三', 'no' => '26010003', 'class' => '计算机应用技术1班'], // 行
    ['name' => '李四', 'no' => '26010004', 'class' => '计算机应用技术1班'], // 行
    ['name' => '王五', 'no' => '26010005', 'class' => '计算机应用技术1班'], // 行
    ['name' => '赵六', 'no' => '26010006', 'class' => '计算机应用技术1班'], // 行
    ['name' => '杨七', 'no' => '26010007', 'class' => '计算机应用技术1班'], // 行
    ['name' => '黄八', 'no' => '26010008', 'class' => '计算机应用技术1班'], // 行
    ['name' => '刘九', 'no' => '26010009', 'class' => '计算机应用技术1班'], // 行
    ['name' => '周十', 'no' => '26010010', 'class' => '计算机应用技术1班'], // 行
];

$csv->filename(__DIR__.'/data/write-example1.csv')
    ->write($data);

// 2、对列进行格式化写入
$csv->filename(__DIR__.'/data/write-example2.csv')
    ->formats([
        // 列索引 => 格式化回调|常量
        'name' => fn($name) => "名称:$name",
        'class' => "计应1班"
    ])
    // 或者单独设置
    ->format('no', fn($no) => ":$no")
    ->write($data);

// 3、回调式写入
$csv->filename(__DIR__.'/data/write-example3.csv')
    ->formats([
        // 列索引 => 格式化回调|常量
        'name' => fn($name) => "名称:$name",
        'class' => "计应2班" // 区分
    ])
    // 或者单独设置
    ->format('no', fn($no) => ":$no")
    ->writeFn(function (\Closure $addFn) use($data) {
        foreach($data as $row) {
            $addFn($row);
        }
    });


// 4、门面写入
PhpCsv\Facade\Csv::filename(__DIR__.'/data/write-example4.csv')
    ->write($data);

// 5、对列进行格式化写入
PhpCsv\Facade\Csv::filename(__DIR__.'/data/write-example5.csv')
    ->formats([
        // 列索引 => 格式化回调|常量
        'name' => fn($name) => "名称:$name",
        'class' => "计应1班"
    ])
    // 或者单独设置
    ->format('no', fn($no) => ":$no")
    ->write($data);

// 6、回调工写入
PhpCsv\Facade\Csv::filename(__DIR__.'/data/write-example6.csv')
    ->formats([
        // 列索引 => 格式化回调|常量
        'name' => fn($name) => "名称:$name",
        'class' => "计应2班"
    ])
    // 或者单独设置
    ->format('no', fn($no) => ":$no")
    ->writeFn(function (\Closure $addFn) use($data) {
        foreach($data as $row) {
            $addFn($row);
        }
    });
