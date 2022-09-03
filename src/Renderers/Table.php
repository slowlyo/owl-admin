<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Table 表格</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/table
 *
 * @method self title($value) 标题
 * @method self source($value) 数据源, 绑定当前环境变量
 * @method self affixHeader($value = true) 是否固定表头
 * @method self columnsTogglable($value) 展示列显示开关, 自动即：列数量大于或等于 5 个时自动开启
 * @method self placeholder($value) 当没数据的时候的文字提示
 * @method self className($value) 外层 CSS 类名
 * @method self tableClassName($value) 表格 CSS 类名
 * @method self headerClassName($value) 顶部外层 CSS 类名
 * @method self footerClassName($value) 底部外层 CSS 类名
 * @method self toolbarClassName($value) 工具栏 CSS 类名
 * @method self columns($value) 用来设置列信息
 * @method self combineNum($value) 自动合并单元格
 * @method self itemActions($value) 悬浮行操作按钮组
 * @method self itemCheckableOn($value) 配置当前行是否可勾选的条件，要用 表达式
 * @method self itemDraggableOn($value) 配置当前行是否可拖拽的条件，要用 表达式
 * @method self checkOnItemClick($value) 点击数据行是否可以勾选当前行
 * @method self rowClassName($value) 给行添加 CSS 类名
 * @method self rowClassNameExpr($value) 通过模板给行添加 CSS 类名
 * @method self prefixRow($value) 顶部总结行
 * @method self affixRow($value) 底部总结行
 * @method self itemBadge($value) 行角标配置
 * @method self autoFillHeight($value) 内容区域自适应高度
 * @method self resizable($value = true) 列宽度是否支持调整
 * @method self selectable($value = true) 支持勾选
 * @method self multiple($value = true) 勾选icon是否为多选样式checkbox， 默认为radio
 */
class Table extends BaseRenderer
{
    public string $type = 'table';
}
