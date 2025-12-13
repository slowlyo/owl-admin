<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 图片集展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/images
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Images extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'images');
    }

    /**
     * 外层 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 当前展示图片索引
     */
    public function currentIndex($value = '')
    {
        return $this->set('currentIndex', $value);
    }

    /**
     * 默认图片地址 (默认图片地址)
     */
    public function defaultImage($value = '')
    {
        return $this->set('defaultImage', $value);
    }

    /**
     * 配置值的连接符
     */
    public function delimiter($value = ',')
    {
        return $this->set('delimiter', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     * 展示模式，支持缩略图模式（thumb）和大图模式（full） 可选值: thumb | full
     */
    public function displayMode($value = '')
    {
        return $this->set('displayMode', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 是否启动放大功能。
     */
    public function enlargeAble($value = true)
    {
        return $this->set('enlargeAble', $value);
    }

    /**
     * 放大时是否显示图片集
     */
    public function enlargetWithImages($value = true)
    {
        return $this->set('enlargetWithImages', $value);
    }

    /**
     * 描述文字样式
     */
    public function fontStyle($value = '')
    {
        return $this->set('fontStyle', $value);
    }

    /**
     * 大图模式下的缩放模式 可选值: cover | contain
     */
    public function fullThumbMode($value = '')
    {
        return $this->set('fullThumbMode', $value);
    }

    /**
     * 高度（有sortType时生效）
     */
    public function height($value = '')
    {
        return $this->set('height', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 鼠标悬浮时的展示状态（对应AIpage的文字6，9，10不存在） 可选值: hover-slide | pull-top | scale-center | scale-top | text-style-1 | text-style-2 | text-style-3 | text-style-4 | text-style-5 | text-style-6 | text-style-7
     */
    public function hoverMode($value = '')
    {
        return $this->set('hoverMode', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 放大详情图 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function imageGallaryClassName($value = '')
    {
        return $this->set('imageGallaryClassName', $value);
    }

    /**
     * 列表 CSS 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function listClassName($value = '')
    {
        return $this->set('listClassName', $value);
    }

    /**
     * 蒙层颜色
     */
    public function maskColor($value = '')
    {
        return $this->set('maskColor', $value);
    }

    /**
     * 关联字段名，也可以直接配置 src
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 配置固定值
     */
    public function options($value = '')
    {
        return $this->set('options', $value);
    }

    /**
     * 大图地址，不设置用 src 属性，如果不是请配置，如：${imageOriginUrl}
     */
    public function originalSrc($value = '')
    {
        return $this->set('originalSrc', $value);
    }

    /**
     * 列表为空时显示
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 是否显示尺寸。
     */
    public function showDimensions($value = true)
    {
        return $this->set('showDimensions', $value);
    }

    /**
     * 是否展示图片工具栏
     */
    public function showToolbar($value = true)
    {
        return $this->set('showToolbar', $value);
    }

    /**
     * 排列方式 类命名方式按照上右下左四个边命名，l=2m，m=2s，最小单位为s 每条边的顺序都是从上到下，从左到右。 可选值: sm-ss-sss-m | sss-ss-ms-m | sms-ss-sms-m | sm-ss-sss-ss | ms-ss-sss-ss | sss-ss-sm-ss | mss-ss-ssm-ss | sss-ss-mm-ss | even-${number}-${number}
     */
    public function sortType($value = '')
    {
        return $this->set('sortType', $value);
    }

    /**
     * 数据源: 绑定当前环境变量 (数据源: 绑定当前环境变量)
     */
    public function source($value = '')
    {
        return $this->set('source', $value);
    }

    /**
     * 图片地址，默认读取数据中的 image 属性，如果不是请配置 ,如  ${imageUrl}
     */
    public function src($value = '')
    {
        return $this->set('src', $value);
    }

    /**
     * 是否静态展示
     */
    public function static($value = true)
    {
        return $this->set('static', $value);
    }

    /**
     * 静态展示表单项类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 静态展示表单项Value类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 静态展示表单项Label类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 是否静态展示表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function staticOn($value = '')
    {
        return $this->set('staticOn', $value);
    }

    /**
     * 静态展示空值占位
     */
    public function staticPlaceholder($value = '')
    {
        return $this->set('staticPlaceholder', $value);
    }

    /**
     * 
     */
    public function staticSchema($value = '')
    {
        return $this->set('staticSchema', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 
     */
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 预览图模式 可选值: w-full | h-full | contain | cover
     */
    public function thumbMode($value = '')
    {
        return $this->set('thumbMode', $value);
    }

    /**
     * 预览图比率 可选值: 1:1 | 4:3 | 16:9
     */
    public function thumbRatio($value = '')
    {
        return $this->set('thumbRatio', $value);
    }

    /**
     * 工具栏配置
     */
    public function toolbarActions($value = '')
    {
        return $this->set('toolbarActions', $value);
    }

    /**
     * 指定为图片集渲染器
     */
    public function type($value = '')
    {
        return $this->set('type', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 默认值，切记只能是静态值，不支持取变量，跟数据关联是通过设置 name 属性来实现的。
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
    }

    /**
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }

    /**
     * 宽度（有sortType时生效）
     */
    public function width($value = '')
    {
        return $this->set('width', $value);
    }


}
