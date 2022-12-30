<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self title($value) 指定列标题
 * @method self copyable($value) 可复制
 * @method self sorter($value) 快速排序
 * @method self align($value) 内容居左、居中、居右
 * @method self rowSpanExpr($value) 指定行合并表达式
 * @method self colSpanExpr($value) 指定列合并表达式
 * @method self fixed($value) 是否固定在左侧/右侧
 * @method self classNameExpr($value) 单元格样式
 * @method self type($value) 指定列内容渲染器
 * @method self searchable($value) 快速搜索
 * @method self toggled($value) 当前列是否展示
 * @method self className($value) 列样式
 * @method self titleClassName($value) 表头单元格样式
 * @method self name($value) 指定列唯一标识
 * @method self children($value) 表头分组
 * @method self remark($value) 列表头提示
 */
class Column extends BaseRenderer
{
}
