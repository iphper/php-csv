# phpCsv

## 使用教程
1. 方法列表

|  方法   | 描述  | 示例 |
|  ----  | ----  | --- |
| filename   | 设置文件名称 | $csv->filename(string): static |
| read  | 读取文件 | $csv->read(?string) : array |
| readFn | 按行回调读取 | $csv->readFn(fn ($row) => var_dump($row)) |
| write | 写入文件 | $csv->write(array $data) |
| writeFn | 按回调写入文件 | $csv->writeFn(fn($add) => $add([['名', '年']])) |
| format | 格式化列 | $csv->format('列名', fn($v) => $v) |
| formats | 格式化多列 | $csv->format(['列名' => fn($v) => $v), ...] |

## 使用示例
```
test/test.php
```
