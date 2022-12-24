<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Table 表格渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/table
 *
 * @method self resizable($value) 是否可调整列宽
 * @method self autoFillHeight($value) 表格自动计算高度
 * @method self static($value) 是否静态展示
 * @method self footerClassName($value) 底部外层 CSS 类名
 * @method self title($value) 标题
 * @method self combineFromIndex($value) 合并单元格配置，配置从第几列开始合并。
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self type($value) 指定为表格渲染器。 可选值: table | static-table | 
 * @method self source($value) 数据源：绑定当前环境变量
 * @method self itemBadge($value) 行角标
 * @method self hidden($value) 是否隐藏
 * @method self headerClassName($value) 顶部外层 CSS 类名
 * @method self toolbarClassName($value) 工具栏 CSS 类名
 * @method self affixRow($value) 底部总结行
 * @method self visible($value) 是否显示
 * @method self onEvent($value) 事件动作配置
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticSchema($value) 
 * @method self className($value) 容器 css 类名
 * @method self disabled($value) 是否禁用
 * @method self disabledOn($value) 是否禁用表达式
 * @method self columns($value) 表格的列信息
 * @method self columnsTogglable($value) 展示列显示开关，自动即：列数量大于或等于5个时自动开启
 * @method self showFooter($value) 是否显示底部
 * @method self canAccessSuperData($value) 表格是否可以获取父级数据域值，默认为false
 * @method self combineNum($value) 合并单元格配置，配置数字表示从左到右的多少列自动合并单元格。
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self showHeader($value) 是否显示头部
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self tableClassName($value) 表格 CSS 类名
 * @method self rowClassNameExpr($value) 行样式表表达式
 * @method self autoGenerateFilter($value) 开启查询区域，会根据列元素的searchable属性值，自动生成查询条件表单
 * @method self placeholder($value) 占位符
 * @method self prefixRow($value) 顶部总结行
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self affixHeader($value) 是否固定表头
 * @method self footable($value) 是否开启底部展示功能，适合移动端展示
 */
class Table extends BaseRenderer
{
    public string $type = 'table';
}
