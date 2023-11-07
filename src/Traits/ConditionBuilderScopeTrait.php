<?php

namespace Slowlyo\OwlAdmin\Traits;

/**
 * 条件组合查询作用域
 *
 * @property  self|\Illuminate\Database\Query\Builder withConditionBuilder()
 */
trait ConditionBuilderScopeTrait
{
    public function scopeWithConditionBuilder($query)
    {
        $filter = request('filter_condition_builder');

        if (blank($filter)) {
            return $query;
        }

        try {
            return $query->where(fn($q) => $this->buildConditionBuilderQuery($q, $filter));
        } catch (\Throwable $e) {
            admin_abort('ConditionBuilder Parser Error!');
        }
    }

    /**
     * 构建条件组合查询
     *
     * @param $query
     * @param $filter
     *
     * @return void
     */
    protected function buildConditionBuilderQuery($query, $filter)
    {
        $or = $filter['conjunction'];

        if (method_exists($this, 'qualifyColumn')) {
            $qualifyColumn = fn($field) => $this->qualifyColumn($field);
        } else {
            $qualifyColumn = fn($field) => $field;
        }

        foreach ($filter['children'] as $item) {
            $field = data_get($item, 'left.field');
            $op    = data_get($item, 'op');
            $value = data_get($item, 'right');

            // 条件组
            if (data_get($item, 'children')) {
                $fn = $or == 'or' ? 'orWhere' : 'where';

                $query->{$fn}(fn($q) => $this->buildConditionBuilderQuery($q, $item));
            }

            // 过滤异常值
            if (blank($field) || blank($op)) {
                continue;
            }

            // 拼接当前表名
            $field = $qualifyColumn($field);

            // 组合查询条件
            switch ($op) {
                case 'equal': // 等于
                case 'select_equals': // 选项 - 等于
                    $query->where($field, '=', $value, $or);
                    break;
                case 'not_equal': // 不等于
                case 'select_not_equals': // 选项 - 不等于
                    $query->where($field, '!=', $value, $or);
                    break;
                case 'is_empty': // 为空
                    $query->whereNull($field, $or);
                    break;
                case 'is_not_empty': // 不为空
                    $query->whereNotNull($field, $or);
                    break;
                case 'like': // 模糊匹配
                    $query->where($field, 'like', "%{$value}%", $or);
                    break;
                case 'not_like': // 不匹配
                    $query->where($field, 'not like', "%{$value}%", $or);
                    break;
                case 'starts_with': // 匹配开头
                    $query->where($field, 'like', "{$value}%", $or);
                    break;
                case 'ends_with': // 匹配结尾
                    $query->where($field, 'like', "%{$value}", $or);
                    break;
                case 'less': // 小于
                    $query->where($field, '<', $value, $or);
                    break;
                case 'less_or_equal': // 小于等于
                    $query->where($field, '<=', $value, $or);
                    break;
                case 'greater': // 大于
                    $query->where($field, '>', $value, $or);
                    break;
                case 'greater_or_equal': // 大于等于
                    $query->where($field, '>=', $value, $or);
                    break;
                case 'between': // 属于范围
                    $query->whereBetween($field, $value, $or);
                    break;
                case 'not_between': // 不属于范围
                    $query->whereNotBetween($field, $value, $or);
                    break;
                case 'select_any_in': // 选项 - 包含
                    $query->whereIn($field, $value, $or);
                    break;
                case 'select_not_any_in': // 选项 - 不包含
                    $query->whereNotIn($field, $value, $or);
                    break;
                default:
                    // 自定义条件
                    if (method_exists($this, 'extraConditionBuilderQuery')) {
                        $this->extraConditionBuilderQuery($query, $item, $or);
                    }
                    break;
            }
        }
    }
}
