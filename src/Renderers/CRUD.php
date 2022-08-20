<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>CRUD 增删改查</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/crud
 *
 * @method self mode($value) "table" 、"cards" 或者 "list"
 * @method self title($value) 可设置成空，当设置成空时，没有标题栏
 * @method self className($value) 表格外层 Dom 的类名
 * @method self api($value) 用来获取列表数据的 api。
 * @method self loadDataOnce($value) 是否一次性加载所有数据（前端分页）
 * @method self loadDataOnceFetchOnFilter($value) 在开启 loadDataOnce 时，filter 时是否去重新请求 api
 * @method self source($value) 数据映射接口返回某字段的值，不设置会默认使用接口返回的$'{ items }'或者$'{ rows }'，也可以设置成上层数据源的内容
 * @method self filter($value) 设置过滤器，当该表单提交后，会把数据带给当前 mode 刷新列表。
 * @method self filterTogglable($value) 是否可显隐过滤器
 * @method self filterDefaultVisible($value) 设置过滤器默认是否可见。
 * @method self initFetch($value) 是否初始化的时候拉取数据, 只针对有 filter 的情况, 没有 filter 初始都会拉取数据
 * @method self interval($value) 刷新时间(最低 1000)
 * @method self silentPolling($value) 配置刷新时是否隐藏加载动画
 * @method self stopAutoRefreshWhen($value) 通过表达式来配置停止刷新的条件
 * @method self stopAutoRefreshWhenModalIsOpen($value) 当有弹框时关闭自动刷新，关闭弹框又恢复
 * @method self syncLocation($value) 是否将过滤条件的参数同步到地址栏
 * @method self draggable($value) 是否可通过拖拽排序
 * @method self resizable($value) 是否可以调整列宽度
 * @method self itemDraggableOn($value) 用表达式来配置是否可拖拽排序
 * @method self saveOrderApi($value) 保存排序的 api。
 * @method self quickSaveApi($value) 快速编辑后用来批量保存的 API。
 * @method self quickSaveItemApi($value) 快速编辑配置成及时保存时使用的 API。
 * @method self bulkActions($value) 批量操作列表，配置后，表格可进行选中操作。
 * @method self messages($value) 覆盖消息提示，如果不指定，将采用 api 返回的 message
 * @method self primaryField($value) 设置 ID 字段名。
 * @method self perPage($value) 设置一页显示多少条数据。
 * @method self orderBy($value) 默认排序字段，这个是传给后端，需要后端接口实现
 * @method self orderDir($value) 排序方向
 * @method self defaultParams($value) 设置默认 filter 默认参数，会在查询的时候一起发给后端
 * @method self pageField($value) 设置分页页码字段名。
 * @method self perPageField($value) 设置分页一页显示的多少条数据的字段名。注意：最好与 defaultParams 一起使用，请看下面例子。
 * @method self perPageAvailable($value) 设置一页显示多少条数据下拉框可选条数。
 * @method self orderField($value) 设置用来确定位置的字段名，设置后新的顺序将被赋值到该字段中。
 * @method self hideQuickSaveBtn($value) 隐藏顶部快速保存提示
 * @method self autoJumpToTopOnPagerChange($value) 当切分页的时候，是否自动跳顶部。
 * @method self syncResponse2Query($value) 将返回数据同步到过滤器上。
 * @method self keepItemSelectionOnPageChange($value) 保留条目选择，默认分页、搜素后，用户选择条目会被清空，开启此选项后会保留用户选择，可以实现跨页面批量操作。
 * @method self labelTpl($value) 单条描述模板，keepItemSelectionOnPageChange设置为true后会把所有已选择条目列出来，此选项可以用来定制条目展示文案。
 * @method self headerToolbar($value) 顶部工具栏配置
 * @method self footerToolbar($value) 底部工具栏配置
 * @method self alwaysShowPagination($value) 是否总是显示分页
 * @method self affixHeader($value) 是否固定表头(table 下)
 * @method self autoGenerateFilter($value) 是否开启查询区域，开启后会根据列元素的 searchable 属性值，自动生成查询条件表单
 * @method self columns($value)
 * @method self checkOnItemClick($value)
 */
class CRUD extends BaseRenderer
{
    public string $type = 'crud';
}
