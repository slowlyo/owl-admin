<?php

namespace Slowlyo\OwlAdmin\Renderers;

use Slowlyo\OwlAdmin\Traits\UploadTrait;

/**
 * WangEditor
 *
 * @author  slowlyo
 * @version v6.0.0
 */
class WangEditor extends BaseRenderer
{
    use UploadTrait;

    public function __construct()
    {
        $this->set('type', 'custom-wang-editor');

        $this->uploadImageServer($this->uploadRichPath(true))->uploadVideoServer($this->uploadRichPath(true));
    }

    /**
     * 自动填充
     */
    public function autoFill($value = '')
    {
        return $this->set('autoFill', $value);
    }

    /**
     * 自动获取焦点
     */
    public function autoFocus($value = true)
    {
        return $this->set('autoFocus', $value);
    }

    /**
     * 设置类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 当前表单项隐藏时是否清除值
     */
    public function clearValueOnHidden($value = true)
    {
        return $this->set('clearValueOnHidden', $value);
    }

    /**
     * 描述
     */
    public function description($value = '')
    {
        return $this->set('description', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 当前表单项是否禁用的条件
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     * 排除按钮
     */
    public function excludeKeys($value = '')
    {
        return $this->set('excludeKeys', $value);
    }

    /**
     * 编辑器高度 px
     */
    public function height($value = '')
    {
        return $this->set('height', $value);
    }

    /**
     * 插入按钮
     */
    public function insertKeys($value = '')
    {
        return $this->set('insertKeys', $value);
    }

    /**
     * 字段标签
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 表单项标签对齐方式，默认右对齐，仅在 mode为horizontal 时生效
     */
    public function labelAlign($value = '')
    {
        return $this->set('labelAlign', $value);
    }

    /**
     * 表单项标签描述
     */
    public function labelRemark($value = '')
    {
        return $this->set('labelRemark', $value);
    }

    /**
     * 最大长度
     */
    public function maxLength($value = '')
    {
        return $this->set('maxLength', $value);
    }

    /**
     * 字段名
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 占位符
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 备注
     */
    public function remark($value = '')
    {
        return $this->set('remark', $value);
    }

    /**
     * 是否必填
     */
    public function required($value = true)
    {
        return $this->set('required', $value);
    }

    /**
     * 是否必填的条件
     */
    public function requiredOn($value = '')
    {
        return $this->set('requiredOn', $value);
    }

    /**
     * 是否静态展示
     */
    public function static($value = true)
    {
        return $this->set('static', $value);
    }

    /**
     * 工具栏按钮
     */
    public function toolbarKeys($value = '')
    {
        return $this->set('toolbarKeys', $value);
    }

    /**
     * 指定为 wang-editor 渲染器。
     */
    public function type($value = 'custom-wang-editor')
    {
        return $this->set('type', $value);
    }

    /**
     * 上传图片的最大数量 默认 100
     */
    public function uploadImageMaxNumber($value = '')
    {
        return $this->set('uploadImageMaxNumber', $value);
    }

    /**
     * 上传图片的最大大小 单位: K 默认 2M
     */
    public function uploadImageMaxSize($value = '')
    {
        return $this->set('uploadImageMaxSize', $value);
    }

    /**
     * 上传图片的服务器地址
     */
    public function uploadImageServer($value = '')
    {
        return $this->set('uploadImageServer', $value);
    }

    /**
     * 上传视频的最大数量 默认 5
     */
    public function uploadVideoMaxNumber($value = '')
    {
        return $this->set('uploadVideoMaxNumber', $value);
    }

    /**
     * 上传视频的最大大小 单位: K 默认 10M
     */
    public function uploadVideoMaxSize($value = '')
    {
        return $this->set('uploadVideoMaxSize', $value);
    }

    /**
     * 上传视频的服务器地址
     */
    public function uploadVideoServer($value = '')
    {
        return $this->set('uploadVideoServer', $value);
    }

    /**
     * 校验接口
     */
    public function validateApi($value = '')
    {
        return $this->set('validateApi', $value);
    }

    /**
     * 校验错误信息
     */
    public function validationErrors($value = '')
    {
        return $this->set('validationErrors', $value);
    }

    /**
     * 校验规则
     */
    public function validations($value = '')
    {
        return $this->set('validations', $value);
    }

    /**
     * 默认值
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
     * 当前表单项是否显示的条件
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
