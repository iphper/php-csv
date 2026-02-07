<?php

namespace PhpCsv\Traits;

// 排除筛选
trait ColumnTrait
{
    protected array $column = [];

    public function columns(array $columns)
    {
        if (!empty($columns)) {
            foreach($columns as $old => $new) {
                $this->columnSet($old, $new);
            }
        }
        return $this;
    }

    public function column(string $old, $new)
    {
        return $this->columnSet($old, $new);
    }

    protected function columnSet($old, $new)
    {
        $this->column[$old] = $new;
        return $this;
    }

    protected function columnGet($column)
    {
        return $this->column[$column] ?? null;
    }

    protected function columnCall($data)
    {
        foreach($data as $column => $value) {
            $newColumn = $this->columnHandle($column);
            if ($newColumn !== $column) {
                unset($data[$column]);
            }
            $data[$newColumn] = $value;
        }
        return $data;
    }

    protected function columnHandle($column)
    {
        $newColumn = $this->columnGet($column);
        if (empty($newColumn)) {
            return $column;
        }
        
        switch(true) {
            case is_scalar($newColumn) === true: // 普通类型
                break;
            case is_callable($newColumn) === true: // 回调类型
                $newColumn = $newColumn($column);
            case is_array($newColumn) === true:
                $newColumn = implode('_', $newColumn);
                break;
            default:
                return $column;
        }
        return $newColumn;
    }
}
