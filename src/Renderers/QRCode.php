<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>QRCode 二维码</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/qrcode
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self qrcodeClassName($value) 二维码 SVG 的类名
 * @method self codeSize($value) 二维码的宽高大小
 * @method self backgroundColor($value) 二维码背景色
 * @method self foregroundColor($value) 二维码前景色
 * @method self level($value) 二维码复杂级别，有（'L' 'M' 'Q' 'H'）四种
 * @method self value($value) 扫描二维码后显示的文本，如果要显示某个页面请输入完整 url（"http://..."或"https://..."开头），支持使用 模板
 * @method self imageSettings($value) 图片配置
 */
class QRCode extends BaseRenderer
{
    public string $type = 'qr-code';
}
