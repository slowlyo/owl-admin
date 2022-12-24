<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>InputExcel 解析 Excel</b><br/>
 * 这个组件是通过前端对 Excel 进行解析，将结果作为表单项
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-excel
 *
 * @method self allSheets($value) 是否解析所有 sheet
 * @method self parseMode($value) 解析模式
 * @method self includeEmpty($value) 是否包含空值
 * @method self plainText($value) 是否解析为纯文本
 *
 */
class InputExcel extends BaseRenderer
{
    public string $type = 'input-excel';
}
