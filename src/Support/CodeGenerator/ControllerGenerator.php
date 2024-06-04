<?php

namespace Slowlyo\OwlAdmin\Support\CodeGenerator;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ControllerGenerator extends BaseGenerator
{
    public function generate()
    {
        return $this->writeFile($this->model->controller_name, 'Controller');
    }

    public function preview()
    {
        return $this->assembly();
    }

    public function assembly()
    {
        $name             = $this->model->controller_name;
        $class            = Str::of($name)->explode('/')->last();
        $serviceClass     = str_replace('/', '\\', $this->model->service_name);
        $serviceClassName = Str::of($serviceClass)->explode('\\')->last();

        $content = '<?php' . PHP_EOL . PHP_EOL;
        $content .= 'namespace ' . $this->getNamespace($name) . ';' . PHP_EOL . PHP_EOL;
        $content .= "use {$serviceClass};" . PHP_EOL;
        $content .= 'use Slowlyo\OwlAdmin\Controllers\AdminController;' . PHP_EOL . PHP_EOL;
        $content .= '/**' . PHP_EOL;
        $content .= ' * ' . $this->model->title . PHP_EOL;
        $content .= ' *' . PHP_EOL;
        $content .= " * @property {$serviceClassName} \$service" . PHP_EOL;
        $content .= ' */' . PHP_EOL;
        $content .= "class {$class} extends AdminController" . PHP_EOL;
        $content .= '{' . PHP_EOL;
        $content .= "\tprotected string \$serviceName = {$serviceClassName}::class;" . PHP_EOL . PHP_EOL;

        $this->replaceListContent($content);
        $this->replaceFormContent($content);
        $this->replaceDetailContent($content);

        $content .= '}';

        return $content;
    }

    protected function replaceListContent(&$content)
    {
        $content .= "\tpublic function list()" . PHP_EOL;
        $content .= "\t{" . PHP_EOL;
        $content .= "\t\t\$crud = \$this->baseCRUD()" . PHP_EOL;
        $content .= "\t\t\t->filterTogglable(false)" . PHP_EOL;

        // 顶部工具栏
        if ($this->model->page_info['dialog_form']) {
            $content .= "\t\t\t->headerToolbar([" . PHP_EOL;
            $content .= "\t\t\t\t\$this->createButton(true{$this->getDialogSize()})," . PHP_EOL;
            $content .= "\t\t\t\t...\$this->baseHeaderToolBar()" . PHP_EOL;
            $content .= "\t\t\t])" . PHP_EOL;
        }

        // 字段
        $content .= "\t\t\t->columns([" . PHP_EOL;

        $primaryKey     = $this->model->primary_key ?? 'id';
        $primaryKeyName = strtoupper($primaryKey);

        $content .= "\t\t\t\t" . "amis()->TableColumn('{$primaryKey}', '{$primaryKeyName}')->sortable()," . PHP_EOL;

        foreach ($this->model->columns as $column) {
            if (!$this->columnInTheScope($column, 'list')) {
                continue;
            }

            $item = $this->getColumnComponent('list_component', $column);

            if ($column['type'] == 'integer' && !Str::contains($column['name'], '_id')) {
                $item .= '->sortable()';
            }

            $content .= "\t\t\t\t" . $item . ',' . PHP_EOL;
        }

        if ($this->model->need_timestamps && $this->model->page_info['list_display_created_at']) {
            $content .= "\t\t\t\t" . "amis()->TableColumn('created_at', admin_trans('admin.created_at'))->type('datetime')->sortable()" . ',' . PHP_EOL;
        }

        if ($this->model->need_timestamps && $this->model->page_info['list_display_updated_at']) {
            $content .= "\t\t\t\t" . "amis()->TableColumn('updated_at', admin_trans('admin.updated_at'))->type('datetime')->sortable()" . ',' . PHP_EOL;
        }

        // 操作按钮
        $content .= "\t\t\t\t" . $this->makeRowButton($this->model->page_info) . PHP_EOL;
        $content .= "\t\t\t]);" . PHP_EOL . PHP_EOL;
        $content .= "\t\treturn \$this->baseList(\$crud);" . PHP_EOL;
        $content .= "\t}" . PHP_EOL;
    }

    protected function replaceFormContent(&$content)
    {
        $content .= PHP_EOL;
        $content .= "\tpublic function form(\$isEdit = false)" . PHP_EOL;
        $content .= "\t{" . PHP_EOL;
        $content .= "\t\treturn \$this->baseForm()->body([" . PHP_EOL;

        foreach ($this->model->columns as $column) {
            if (data_get($column, 'index') == 'primary') {
                continue;
            }

            if (!$this->columnInTheScope($column, 'create') && !$this->columnInTheScope($column, 'edit')) {
                continue;
            }

            $item = $this->getColumnComponent('form_component', $column);

            if (!$this->columnInTheScope($column, 'create') && $this->columnInTheScope($column, 'edit')) {
                $item .= '->visibleOn($isEdit)';
            } else if ($this->columnInTheScope($column, 'create') && !$this->columnInTheScope($column, 'edit')) {
                $item .= '->visibleOn(!$isEdit)';
            }

            $content .= "\t\t\t" . $item . ',' . PHP_EOL;
        }

        $content .= "\t\t]);" . PHP_EOL;
        $content .= "\t}" . PHP_EOL;
    }

    protected function replaceDetailContent(&$content)
    {
        $content .= PHP_EOL;
        $content .= "\tpublic function detail()" . PHP_EOL;
        $content .= "\t{" . PHP_EOL;
        $content .= "\t\treturn \$this->baseDetail()->body([" . PHP_EOL;

        $primaryKey     = $this->model->primary_key ?? 'id';
        $primaryKeyName = strtoupper($primaryKey);

        $content .= "\t\t\t" . "amis()->TextControl('{$primaryKey}', '{$primaryKeyName}')->static()," . PHP_EOL;

        foreach ($this->model->columns as $column) {
            if (!$this->columnInTheScope($column, 'detail')) {
                continue;
            }

            $item = $this->getColumnComponent('detail_component', $column);

            $content .= "\t\t\t" . $item . ',' . PHP_EOL;
        }

        if ($this->model->need_timestamps) {
            $content .= "\t\t\tamis()->TextControl('created_at', admin_trans('admin.created_at'))->static()," . PHP_EOL;
            $content .= "\t\t\tamis()->TextControl('updated_at', admin_trans('admin.updated_at'))->static()," . PHP_EOL;
        }

        $content .= "\t\t]);" . PHP_EOL;
        $content .= "\t}" . PHP_EOL;
    }

    public function columnInTheScope($column, $scope)
    {
        if (!Arr::has($column, 'action_scope')) {
            return true;
        }

        return in_array($scope, Arr::get($column, 'action_scope', []));
    }

    public function getColumnComponent($type, $column)
    {
        $label = Arr::get($column, 'comment') ?? Str::studly($column['name']);

        $component = data_get($column, $type);
        if ($componentType = data_get($component, $type . '_type')) {
            $item = "amis()->{$componentType}('{$column['name']}', '{$label}')";
            if ($property = Arr::get($component, $type . '_property')) {
                $item .= collect($property)->map(function ($item) {
                    $_val = Arr::get($item, 'value');

                    if (is_json($_val)) {
                        return '->' . Arr::get($item, 'name') . '(' . $this->jsonToStringArray($_val) . ')';
                    }

                    if (filled($_val) && !in_array($_val, ['true', 'false']) && !is_numeric($_val)) {
                        $_val = "'{$_val}'";
                    }

                    return '->' . Arr::get($item, 'name') . '(' . $_val . ')';
                })->implode('');
            }

            return $item;
        }

        return match ($type) {
            'list_component' => "amis()->TableColumn('{$column['name']}', '{$label}')",
            'form_component' => "amis()->TextControl('{$column['name']}', '{$label}')",
            'detail_component' => "amis()->TextControl('{$column['name']}', '{$label}')->static()",
        };
    }

    private function makeRowButton($pageInfo)
    {
        $_actions   = data_get($pageInfo, 'row_actions');
        $isDialog   = $pageInfo['dialog_form'] ? 'true' : '';
        $dialogSize = $this->getDialogSize();

        if (in_array('show', $_actions) && in_array('edit', $_actions) && in_array('delete', $_actions)) {
            return "\$this->rowActions({$isDialog}{$dialogSize})";
        }

        $str = "\$this->rowActions([\n\t\t\t\t";

        if (in_array('show', $_actions)) {
            $str .= "\t\$this->rowShowButton({$isDialog}{$dialogSize}),\n\t\t\t\t";
        }
        if (in_array('edit', $_actions)) {
            $str .= "\t\$this->rowEditButton({$isDialog}{$dialogSize}),\n\t\t\t\t";
        }
        if (in_array('delete', $_actions)) {
            $str .= "\t\$this->rowDeleteButton({$isDialog}{$dialogSize}),\n\t\t\t\t";
        }
        $str .= "])";

        return $str;
    }

    private function getDialogSize()
    {
        $pageInfo   = $this->model->page_info;
        $dialogSize = $pageInfo['dialog_size'] ?? 'md';
        $dialogSize = $dialogSize == 'md' ? '' : ', \'' . $dialogSize . '\'';

        return $pageInfo['dialog_form'] ? $dialogSize : '';
    }

    /**
     * json 字符串转 PHP 数组字符串
     *
     * @param $jsonString
     *
     * @return string|string[]|null
     */
    private function jsonToStringArray($jsonString)
    {
        // 首先，检查输入是否为有效的JSON字符串
        if (!is_json($jsonString)) {
            return $jsonString;
        }

        $dataArray = json_decode($jsonString, true);

        // 遍历数组，确保所有的字符串都正确处理Unicode编码，特别是中文
        array_walk_recursive($dataArray, function (&$item) {
            if (is_string($item)) {
                $item = mb_convert_encoding($item, 'UTF-8', 'UTF-8');
            }
        });

        // 使用var_export()生成数组的字符串表示，然后将其返回
        $phpArrayString = var_export($dataArray, true);

        // 转换为短数组语法
        $phpArrayString = preg_replace('/array \(/', '[', $phpArrayString);
        $phpArrayString = preg_replace('/\)$/', ']', $phpArrayString);
        $phpArrayString = str_replace(')', ']', $phpArrayString);

        // 去除数字索引
        $phpArrayString = preg_replace('/\d+ => /', '', $phpArrayString);

        // 去除多余的空格和换行，使输出更为紧凑
        $phpArrayString = preg_replace('/ =>\s+\[/', '=> [', $phpArrayString);

        return str_replace(["\r\n", "\r", "\n", "\t", "  "], '', $phpArrayString);
    }
}
