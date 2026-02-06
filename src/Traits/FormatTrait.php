<?php

namespace PhpCsv\Traits;

// 格式化
trait FormatTrait
{
    protected array $fomatter = [];

    protected function formatCall($data)
    {
        foreach($data as $column => $row) {
            $data[$column] = $this->formatHandle($column, $row);
        }
        return $data;
    }

    public function format($column, $formatter)
    {
        return $this->formatSet($column, $formatter);
    }

    public function formats(array $list) : self
    {
        foreach($list as $column => $formatter) {
            $this->format($column, $formatter);
        }
        return $this;
    }

    protected function formatSet($column, $formatter)
    {
        if (empty($this->fomatter[$column])) {
            $this->fomatter[$column] = [$formatter];
        }
        else {
            $this->fomatter[$column][] = $formatter;
        }
        return $this;
    }

    protected function formatGet($column)
    {
        return $this->fomatter[$column] ?? [];
    }

    protected function formatHandle($column, $val)
    {
        if (!empty($list = $this->formatGet($column))) {
            // 按顺序格式化
            foreach($list as $item) {
                switch(true) {
                    case is_callable($item) === true:
                        $val = $item($val);
                        break;
                    case is_scalar($item):
                        $val = $item;
                        break;
                }
            }
        }
        return $val;
    }

}
