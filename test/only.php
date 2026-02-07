<?php

include_once __DIR__ . '/../vendor/autoload.php';

use PhpCsv\Csv\Csv;

$csv = new Csv();

# 一、读取

// 1、读取
// 普通读取
// $data = $csv
//     ->only('0', '陈一')
//     ->only('1', '学号')
//     ->read(__DIR__.'/data/example.csv');
// var_dump($data);

// $data = $csv
//     ->onlys(['0' => '陈一', '1' => fn($i) => in_array($i, ['26010002', '26010003'])])
//     ->read(__DIR__.'/data/example.csv');
// var_dump($data);

// $data = $csv
//     ->onlys(['0' => '陈一', '1' => ['26010002', '26010003']])
//     ->read(__DIR__.'/data/example.csv');
// var_dump($data);


