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

        // 筛选
        $filter = FilterGenerator::make($this->model)->renderComponent();
        if (blank($filter)) {
            $content .= "\t\t\t->filterTogglable(false)" . PHP_EOL;
        } else {
            $content .= $filter;
        }

        // 批量操作
        if (!in_array('batch_delete', $this->model->page_info['row_actions'])) {
            $content .= "\t\t\t->bulkActions([])" . PHP_EOL;
        }

        // 顶部工具栏
        $dialog = $this->model->page_info['dialog_form'];
        if ($dialog != 'page' && in_array('create', $this->model->page_info['row_actions'])) {
            $content .= "\t\t\t->headerToolbar([" . PHP_EOL;
            $content .= "\t\t\t\t\$this->createButton('{$dialog}'{$this->getDialogSize()})," . PHP_EOL;
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
        $rowActions = $this->makeRowButton($this->model->page_info);
        if (filled($rowActions)) {
            $content .= "\t\t\t\t" . $rowActions . PHP_EOL;
        }
        $content .= "\t\t\t]);" . PHP_EOL . PHP_EOL;
        $content .= "\t\treturn \$this->baseList(\$crud);" . PHP_EOL;
        $content .= "\t}" . PHP_EOL;
    }

    protected function replaceFormContent(&$content)
    {
        $content .= PHP_EOL;
        $content .= "\tpublic function form(\$isEdit = false)" . PHP_EOL;
        $content .= "\t{" . PHP_EOL;
        if ($this->model->page_info['dialog_form'] == 'drawer') {
            $content .= "\t\treturn \$this->baseForm()->mode('normal')->body([" . PHP_EOL;
        } else {
            $back    = $this->model->page_info['dialog_form'] == 'page' ? 'true' : '';
            $content .= "\t\treturn \$this->baseForm({$back})->body([" . PHP_EOL;
        }

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
        $label = Str::replace("'", "\\'", $label);

        $component = data_get($column, $type);
        if ($componentType = data_get($component, $type . '_type')) {
            $item = "amis()->{$componentType}('{$column['name']}', '{$label}')";
            if ($property = Arr::get($component, $type . '_property')) {
                $item .= $this->buildComponentProperty($property);
            }

            return $item;
        }

        return match ($type) {
            'list_component'   => "amis()->TableColumn('{$column['name']}', '{$label}')",
            'form_component'   => "amis()->TextControl('{$column['name']}', '{$label}')",
            'detail_component' => "amis()->TextControl('{$column['name']}', '{$label}')->static()",
        };
    }

    private function makeRowButton($pageInfo)
    {
        $hasRowAction = false;
        $_actions     = data_get($pageInfo, 'row_actions');
        $dialog       = $pageInfo['dialog_form'] ? "'{$pageInfo['dialog_form']}'" : '';
        $dialogSize   = $this->getDialogSize();

        if (in_array('show', $_actions) && in_array('edit', $_actions) && in_array('delete', $_actions)) {
            return "\$this->rowActions({$dialog}{$dialogSize})";
        }

        $str = "\$this->rowActions([\n\t\t\t\t";

        if (in_array('show', $_actions)) {
            $hasRowAction = true;
            $str          .= "\t\$this->rowShowButton({$dialog}{$dialogSize}),\n\t\t\t\t";
        }
        if (in_array('edit', $_actions)) {
            $hasRowAction = true;
            $str          .= "\t\$this->rowEditButton({$dialog}{$dialogSize}),\n\t\t\t\t";
        }
        if (in_array('delete', $_actions)) {
            $hasRowAction = true;
            $str          .= "\t\$this->rowDeleteButton(),\n\t\t\t\t";
        }
        $str .= "])";

        if (!$hasRowAction) return '';

        return $str;
    }

    private function getDialogSize()
    {
        $pageInfo   = $this->model->page_info;
        $dialogSize = $pageInfo['dialog_size'] ?? 'md';
        $dialogSize = $dialogSize == 'md' ? '' : ', \'' . $dialogSize . '\'';

        return $pageInfo['dialog_form'] ? $dialogSize : '';
    }
}
