<?php

namespace Slowlyo\OwlAdmin\Libs\CodeGenerator;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ControllerGenerator extends BaseGenerator
{
    protected string $stub = __DIR__ . '/stubs/controller.stub';

    protected string $serviceName = '';

    protected string $tableName = '';

    protected array $pageInfo = [];

    protected Collection $columns;

    protected bool $needTimestamp = false;

    public function timestamps(bool $need): static
    {
        $this->needTimestamp = $need;

        return $this;
    }

    public function serviceName($serviceName): static
    {
        $this->serviceName = $serviceName;

        return $this;
    }

    public function tableName($tableName): static
    {
        $this->tableName = $tableName;

        return $this;
    }

    public function pageInfo($pageInfo): static
    {
        $this->pageInfo = $pageInfo;

        return $this;
    }

    public function columns($columns): static
    {
        $this->columns = $columns;

        if ($this->columns->isEmpty()) {
            abort(HttpResponse::HTTP_BAD_REQUEST, 'Table fields can\'t be empty');
        }

        return $this;
    }

    public function generate($name): bool|string
    {
        $name = str_replace('/', '\\', $name);
        $path = static::guessClassFileName($name);
        $dir  = dirname($path);

        $files = app('files');

        if (!is_dir($dir)) {
            $files->makeDirectory($dir, 0755, true);
        }

        if ($files->exists($path)) {
            abort(HttpResponse::HTTP_BAD_REQUEST, "Controller [$name] already exists!");
        }

        $stub = $files->get($this->stub);

        $stub = $this->replaceClass($stub, $name)
            ->replaceTitle($stub)
            ->replaceNamespace($stub, $name)
            ->replaceService($stub)
            ->replaceListContent($stub)
            ->replaceFormContent($stub)
            ->replaceDetailContent($stub)
            ->replaceSpace($stub);

        $files->put($path, $stub);
        $files->chmod($path, 0777);

        return $path;
    }

    public function preview($name)
    {
        $name  = str_replace('/', '\\', $name);
        $files = app('files');
        $stub  = $files->get($this->stub);

        return $this->replaceClass($stub, $name)
            ->replaceTitle($stub)
            ->replaceNamespace($stub, $name)
            ->replaceService($stub)
            ->replaceListContent($stub)
            ->replaceFormContent($stub)
            ->replaceDetailContent($stub)
            ->replaceSpace($stub);
    }

    protected function replaceService(&$stub): static
    {
        $name = str_replace('/', '\\', $this->serviceName);

        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        $stub = str_replace(['{{ ServiceName }}', '{{ UseService }}'], [$class, $name], $stub);

        return $this;
    }

    protected function replaceListContent(&$stub): static
    {
        $list = collect();

        $primaryKey     = $this->primaryKey ?? 'id';
        $primaryKeyName = strtoupper($primaryKey);
        $list->push("amisMake()->TableColumn('{$primaryKey}', '{$primaryKeyName}')->sortable()");

        $this->columns->each(function ($column) use (&$list) {
            if (!$this->columnInTheScope($column, 'list')) {
                return;
            }

            $item = $this->getColumnComponent('list_component', $column);

            if ($column['type'] == 'integer') {
                $item .= '->sortable(true)';
            }

            $list->push($item);
        });

        if ($this->needTimestamp) {
            $list->push("amisMake()->TableColumn('created_at', __('admin.created_at'))->type('datetime')->sortable(true)");
            $list->push("amisMake()->TableColumn('updated_at', __('admin.updated_at'))->type('datetime')->sortable(true)");
        }

        $list = $list->implode(",\n\t\t\t\t") . ',';

        $stub = str_replace('{{ ListContent }}', $list, $stub);

        // row actions
        $stub = str_replace('{{ RowActions }}', $this->makeRowButton($this->pageInfo), $stub);

        // header toolbar
        $headerToolbar = '';
        if ($this->pageInfo['dialog_form']) {
            $headerToolbar =
                "\n\t\t\t->headerToolbar([\n\t\t\t\t\$this->createButton(true{$this->getDialogSize()}),\n\t\t\t\t...\$this->baseHeaderToolBar()\n\t\t\t])";
        }

        $stub = str_replace('{{ HeaderToolbar }}', $headerToolbar, $stub);

        return $this;
    }

    private function getDialogSize()
    {
        $pageInfo   = $this->pageInfo;
        $dialogSize = $pageInfo['dialog_size'] ?? 'md';
        $dialogSize = $dialogSize == 'md' ? '' : ', \'' . $dialogSize . '\'';

        return $pageInfo['dialog_form'] ? $dialogSize : '';
    }

    private function makeRowButton($pageInfo)
    {
        $_actions   = data_get($pageInfo, 'row_actions');
        $isDialog   = $pageInfo['dialog_form'] ? 'true' : '';
        $dialogSize = $this->getDialogSize();

        if (in_array('show', $_actions) && in_array('edit', $_actions) && in_array('delete', $_actions)) {
            return "\$this->rowActions({$isDialog}{$dialogSize})";
        }
        if (in_array('edit', $_actions) && in_array('delete', $_actions)) {
            return "\$this->rowActionsOnlyEditAndDelete({$isDialog}{$dialogSize})";
        }

        $str = "amisMake()->Operation()->label(__('admin.actions'))->buttons([\n\t\t\t\t";

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

    protected function replaceFormContent(&$stub): static
    {
        $form = collect();

        $this->columns->where('index', '!=', 'primary')->each(function ($column) use (&$form) {
            if (!$this->columnInTheScope($column, 'create') && !$this->columnInTheScope($column, 'edit')) {
                return;
            }

            $item = $this->getColumnComponent('form_component', $column);

            if (!$this->columnInTheScope($column, 'create') && $this->columnInTheScope($column, 'edit')) {
                $item .= '->visibleOn($isEdit)';
            } else if ($this->columnInTheScope($column, 'create') && !$this->columnInTheScope($column, 'edit')) {
                $item .= '->visibleOn(!$isEdit)';
            }


            $form->push($item);
        });

        $form = $form->implode(",\n\t\t\t") . ',';

        $stub = str_replace('{{ FormContent }}', $form, $stub);

        return $this;
    }

    protected function replaceDetailContent(&$stub): static
    {
        $detail = collect();

        $primaryKey     = $this->primaryKey ?? 'id';
        $primaryKeyName = strtoupper($primaryKey);
        $detail->push("amisMake()->TextControl('{$primaryKey}', '{$primaryKeyName}')->static()");

        $this->columns->each(function ($column) use (&$detail) {
            if (!$this->columnInTheScope($column, 'detail')) {
                return;
            }

            $item = $this->getColumnComponent('detail_component', $column);

            $detail->push($item);
        });

        if ($this->needTimestamp) {
            $detail->push("amisMake()->TextControl('created_at', __('admin.created_at'))->static()");
            $detail->push("amisMake()->TextControl('updated_at', __('admin.updated_at'))->static()");
        }

        $detail = $detail->implode(",\n\t\t\t");

        $stub = str_replace('{{ DetailContent }}', $detail, $stub);

        return $this;
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

        if ($component = Arr::get($column, $type . '_type')) {
            $item = "amisMake()->{$component}('{$column['name']}', '{$label}')";
            if ($property = Arr::get($column, $type . '_property')) {
                $item .= collect($property)->map(function ($item) {
                    $_val = Arr::get($item, 'value');

                    if (filled($_val) && !in_array($_val, ['true', 'false']) && !is_numeric($_val)) {
                        $_val = "'{$_val}'";
                    }

                    return '->' . Arr::get($item, 'name') . '(' . $_val . ')';
                })->implode('');
            }

            return $item;
        }

        return match ($type) {
            'list_component' => "amisMake()->TableColumn('{$column['name']}', '{$label}')",
            'form_component' => "amisMake()->TextControl('{$column['name']}', '{$label}')",
            'detail_component' => "amisMake()->TextControl('{$column['name']}', '{$label}')->static()",
        };
    }
}
