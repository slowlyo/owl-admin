<?php

namespace Slowlyo\OwlAdmin\Support\CodeGenerator;

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
        $list->push("amis()->TableColumn('{$primaryKey}', '{$primaryKeyName}')->sortable()");

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
            $list->push("amis()->TableColumn('created_at', __('admin.created_at'))->type('datetime')->sortable(true)");
            $list->push("amis()->TableColumn('updated_at', __('admin.updated_at'))->type('datetime')->sortable(true)");
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
        $detail->push("amis()->TextControl('{$primaryKey}', '{$primaryKeyName}')->static()");

        $this->columns->each(function ($column) use (&$detail) {
            if (!$this->columnInTheScope($column, 'detail')) {
                return;
            }

            $item = $this->getColumnComponent('detail_component', $column);

            $detail->push($item);
        });

        if ($this->needTimestamp) {
            $detail->push("amis()->TextControl('created_at', __('admin.created_at'))->static()");
            $detail->push("amis()->TextControl('updated_at', __('admin.updated_at'))->static()");
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
            $item = "amis()->{$component}('{$column['name']}', '{$label}')";
            if ($property = Arr::get($column, $type . '_property')) {
                $item .= collect($property)->map(function ($item) {
                    $_val = Arr::get($item, 'value');

                    if(is_string($_val) && is_array(json_decode($_val, true)) && (json_last_error() == JSON_ERROR_NONE)){
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

    private function jsonToStringArray($jsonString) {
      // 首先，检查输入是否为有效的JSON字符串
      $dataArray = json_decode($jsonString, true);
      if (json_last_error() !== JSON_ERROR_NONE) {
        // 如果json_decode遇到错误，返回错误信息
        return $jsonString;
      }

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
      $phpArrayString = str_replace(["\r\n", "\r", "\n", "\t", "  "], '', $phpArrayString);

      return $phpArrayString;
    }
}
