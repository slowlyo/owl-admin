<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b> Transfer 穿梭器 </b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/transfer
 *
 * @method self options($value) 选项组
 * @method self source($value) 动态选项组
 * @method self delimeter($value) 拼接符
 * @method self joinValues($value = true) 拼接值
 * @method self extractValue($value = true) 提取值
 * @method self searchApi($value) 如果想通过接口检索，可以设置这个 api。
 * @method self resultListModeFollowSelect($value) 结果面板跟随模式，目前只支持list、table、tree（tree 目前只支持非延时加载的tree）
 * @method self statistics($value = true) 是否显示统计数据
 * @method self selectTitle($value) 左侧的标题文字
 * @method self resultTitle($value) 右侧结果的标题文字
 * @method self sortable($value) 结果可以进行拖拽排序（结果列表为树时，不支持排序）
 * @method self selectMode($value) 可选：list、table、tree、chained、associated。分别为：列表形式、表格形式、树形选择形式、级联选择形式，关联选择形式（与级联选择的区别在于，级联是无限极，而关联只有一级，关联左边可以是个 tree）。
 * @method self searchResultMode($value) 如果不设置将采用 selectMode 的值，可以单独配置，参考 selectMode，决定搜索结果的展示形式。
 * @method self searchable($value) 左侧列表搜索功能，当设置为  true  时表示可以通过输入部分内容检索出选项项。
 * @method self searchPlaceholder($value) 左侧列表搜索框提示
 * @method self columns($value) 当展示形式为 table 可以用来配置展示哪些列，跟 table 中的 columns 配置相似，只是只有展示功能。
 * @method self leftOptions($value) 当展示形式为 associated 时用来配置左边的选项集。
 * @method self leftMode($value) 当展示形式为 associated 时用来配置左边的选择形式，支持 list 或者 tree。默认为 list。
 * @method self rightMode($value) 当展示形式为 associated 时用来配置右边的选择形式，可选：list、table、tree、chained。
 * @method self resultSearchable($value) 结果（右则）列表的检索功能，当设置为 true 时，可以通过输入检索模糊匹配检索内容（目前树的延时加载不支持结果搜索功能）
 * @method self resultSearchPlaceholder($value) 右侧列表搜索框提示
 * @method self menuTpl($value) 用来自定义选项展示
 * @method self valueTpl($value) 用来自定义值的展示
 */
class Transfer extends FormItem
{
    public string $type = 'transfer';
}
