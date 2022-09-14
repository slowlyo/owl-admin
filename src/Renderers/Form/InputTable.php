<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

use Slowlyo\SlowAdmin\Renderers\BaseRenderer;

/**
 * <b>InputTable 表格</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-table
 *
 * @method self addable($value) 是否可增加一行
 * @method self editable($value) 是否可编辑
 * @method self removable($value) 是否可删除
 * @method self showAddBtn($value =true) 是否显示添加按钮
 * @method self addApi($value) 新增时提交的 API
 * @method self updateApi($value) 修改时提交的 API
 * @method self deleteApi($value) 删除时提交的 API
 * @method self addBtnLabel($value) 增加按钮名称
 * @method self addBtnIcon($value) 增加按钮图标
 * @method self copyBtnLabel($value) 复制按钮文字
 * @method self copyBtnIcon($value) 复制按钮图标
 * @method self editBtnLabel($value) 编辑按钮名称
 * @method self editBtnIcon($value) 编辑按钮图标
 * @method self deleteBtnLabel($value) 删除按钮名称
 * @method self deleteBtnIcon($value) 删除按钮图标
 * @method self confirmBtnLabel($value) 确认编辑按钮名称
 * @method self confirmBtnIcon($value) 确认编辑按钮图标
 * @method self cancelBtnLabel($value) 取消编辑按钮名称
 * @method self cancelBtnIcon($value) 取消编辑按钮图标
 * @method self needConfirm($value) 是否需要确认操作，，可用来控控制表格的操作交互
 * @method self canAccessSuperData($value) 是否可以访问父级数据，也就是表单中的同级数据，通常需要跟 strictMode 搭配使用
 * @method self strictMode($value) 为了性能，默认其他表单项项值变化不会让当前表格更新，有时候为了同步获取其他表单项字段，需要开启这个。
 * @method self columns($value) 列信息
 */
class InputTable extends BaseRenderer
{
    public string $type = 'input-table';
}
