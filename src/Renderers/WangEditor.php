<?php

namespace Slowlyo\OwlAdmin\Renderers;

use Slowlyo\OwlAdmin\Traits\Uploader;

/**
 * WangEditor
 *
 * @method self className($value) 设置图标的类名
 * @method self name($value) 字段名
 * @method self label($value) 字段标签
 * @method self placeholder($value) 占位符
 * @method self required($value) 是否必填
 * @method self requiredOn($value) 是否必填的条件
 * @method self value($value) 默认值
 * @method self description($value) 描述
 * @method self remark($value) 备注
 * @method self labelAlign($value) 表单项标签对齐方式，默认右对齐，仅在 mode为horizontal 时生效 "right" | "left"
 * @method self labelRemark($value) 表单项标签描述
 * @method self disabled($value) 是否禁用
 * @method self disabledOn($value) 当前表单项是否禁用的条件
 * @method self visible($value) 是否显示
 * @method self visibleOn($value) 当前表单项是否显示的条件
 * @method self clearValueOnHidden($value) 当前表单项隐藏时是否清除值
 * @method self validations($value) 校验规则
 * @method self validationErrors($value) 校验错误信息
 * @method self validateApi($value) 校验接口
 * @method self autoFill($value) 自动填充
 * @method self static ($value) 是否静态展示
 * @method self autoFocus($value) 自动获取焦点
 * @method self maxLength($value) 最大长度
 * @method self toolbarKeys($value) 工具栏按钮
 * @method self insertKeys($value) 插入按钮
 * @method self excludeKeys($value) 排除按钮
 * @method self uploadImageServer($value) 上传图片的服务器地址
 * @method self uploadImageMaxSize($value) 上传图片的最大大小 单位: K 默认 2M
 * @method self uploadImageMaxNumber($value) 上传图片的最大数量 默认 100
 * @method self uploadVideoServer($value) 上传视频的服务器地址
 * @method self uploadVideoMaxSize($value) 上传视频的最大大小 单位: K 默认 10M
 * @method self uploadVideoMaxNumber($value) 上传视频的最大数量 默认 5
 * @method self height($value) 编辑器高度 px
 */
class WangEditor extends BaseRenderer
{
    use Uploader;

    public string $type = 'custom-wang-editor';

    public function __construct()
    {
        $this->uploadImageServer(url($this->uploadRichPath()));
        $this->uploadVideoServer(url($this->uploadRichPath()));
    }
}
