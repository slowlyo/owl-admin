<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Pagination 分页组件</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/pagination
 * @method self mode($value) 迷你版本/简易版本 (normal | simple) 只显示左右箭头，配合hasNext使用
 * @method self layout($value) 通过控制layout属性的顺序，调整分页结构布局
 * @method self maxButtons($value) 最多显示多少个分页按钮，最小为5
 * @method self lastPage($value) 总页数 （设置总条数total的时候，lastPage会重新计算）
 * @method self total($value) 总条数
 * @method self activePage($value) 当前页数
 * @method self perPage($value)    每页显示多条数据
 * @method self showPerPage($value)    是否展示perPage切换器 layout和showPerPage都可以控制
 * @method self perPageAvailable($value) 指定每页可以显示多少条
 * @method self showPageInput($value) 是否显示快速跳转输入框 layout和showPageInput都可以控制
 * @method self disabled($value) 是否禁用
 * @method self onPageChange($value) 改变时会触发    (page: number, perPage: number) => void 分页改变触发
 */
class Pagination extends BaseRenderer
{
    public string $type = 'pagination';
}
