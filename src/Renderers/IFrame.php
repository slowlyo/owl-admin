<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>iFrame</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/iframe
 *
 * @method self className($value) iFrame 的类名
 * @method self frameBorder($value) frameBorder
 * @method self style($value) 样式对象
 * @method self src($value) iframe 地址
 * @method self allow($value) allow 配置
 * @method self sandbox($value) sandbox 配置
 * @method self referrerpolicy($value) referrerpolicy 配置
 * @method self height($value) iframe 高度
 * @method self width($value) iframe 宽度
 */
class IFrame extends BaseRenderer
{
    public string $type = 'iframe';
}
