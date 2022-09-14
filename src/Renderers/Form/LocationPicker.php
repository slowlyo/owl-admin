<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>LocationPicker 地理位置</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/location-picker
 *
 * @method self vendor($value) 地图厂商，目前只实现了百度地图
 * @method self ak($value) 百度地图的 ak
 * @method self clearable($value) 输入框是否可清空
 * @method self placeholder($value) 默认提示
 * @method self coordinatesType($value) 默为百度坐标，可设置为'gcj02'
 */
class LocationPicker extends FormItem
{
    public string $type = 'location-picker';
}
