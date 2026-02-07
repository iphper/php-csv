<?php

namespace PhpCsv\Traits;

// 仅有筛选
trait OnlyTrait
{
    protected array $only = [];

    public function onlys(array $onlys)
    {
        if (!empty($onlys)) {
            foreach($onlys as $column => $rule) {
                $this->onlySet($column, $rule);
            }
        }
        return $this;
    }

    public function only(string $column, $rule)
    {
        return $this->onlySet($column, $rule);
    }

    protected function onlySet($column, $rule)
    {
        if (empty($this->only[$column])) {
            $this->only[$column] = [];
        }
        $this->only[$column][] = $rule;
        return $this;
    }

    protected function onlyGet($column)
    {
        return $this->only[$column] ?? [];
    }

    protected function onlyCall($data)
    {
        // 如果没有条件就直接返回
        if (empty($this->only)) {
            return $data;
        }
        foreach($data as $column => $row) {
            // 规则正确就直接返回
            if ($this->onlyHandle($column, $row)) {
                return $data;
            }
        }
        return [];
    }

    protected function onlyHandle($column, $val)
    {
        $filter = $this->onlyGet($column);
        // 没有就返回所有
        if (empty($filter)) {
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
