<?php

namespace PhpCsv\Traits;

// 排除筛选
trait ExcludeTrait
{
    protected array $exclude = [];

    public function excludes(array $excludes)
    {
        if (!empty($excludes)) {
            foreach($excludes as $column => $rule) {
                $this->excludeSet($column, $rule);
            }
        }
        return $this;
    }

    public function exclude(string $column, $rule)
    {
        return $this->excludeSet($column, $rule);
    }

    protected function excludeSet($column, $rule)
    {
        if (empty($this->exclude[$column])) {
            $this->exclude[$column] = [];
        }
        $this->exclude[$column][] = $rule;
        return $this;
    }

    protected function excludeGet($column)
    {
        return $this->exclude[$column] ?? [];
    }

    protected function excludeCall($data)
    {
        foreach($data as $column => $row) {
            if ($this->excludeHandle($column, $row)) {
                return [];
            }
        }
        return $data;
    }

    protected function excludeHandle($column, $val)
    {
        $filter = $this->excludeGet($column);
        if (!empty($filter)) {
            return false;
        }
        foreach($filter as $rule) {
            switch(true) {
                case is_scalar($rule) === true: // 普通类型
                    return $rule === $val;
                case is_callable($rule) === true: // 回调类型
                    return $rule($val);
                case is_array($rule) === true:
                    return in_array($val, $rule);
                default:
                    return false;
            }
        }
    }
}
