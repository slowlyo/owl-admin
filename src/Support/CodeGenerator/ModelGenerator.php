<?php

namespace Slowlyo\OwlAdmin\Support\CodeGenerator;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ModelGenerator extends BaseGenerator
{
    protected bool $needSoftDelete = false;

    protected bool $needTimestamp = false;

    protected Collection $columns;

    protected string $stub = __DIR__ . '/stubs/model.stub';

    public function softDelete(bool $need): static
    {
        $this->needSoftDelete = $need;

        return $this;
    }

    public function timestamps(bool $need): static
    {
        $this->needTimestamp = $need;

        return $this;
    }

    public function columns($columns): static
    {
        $this->columns = $columns;

        return $this;
    }

    public function generate($table, $name): bool|string
    {
        $name = str_replace('/', '\\', $name);
        $path = static::guessClassFileName($name);
        $dir  = dirname($path);

        $files = app('files');

        if (!is_dir($dir)) {
            $files->makeDirectory($dir, 0755, true);
        }

        if ($files->exists($path)) {
            abort(HttpResponse::HTTP_BAD_REQUEST, "Model [$name] already exists!");
        }

        $stub = $files->get($this->stub);

        $stub = $this->replaceClass($stub, $name)
            ->replaceTitle($stub)
            ->replaceNamespace($stub, $name)
            ->replaceSoftDeletes($stub)
            ->replaceTable($stub, $table, $name)
            ->replaceTimestamp($stub)
            ->replaceContent($stub)
            ->replacePrimaryKey($stub)
            ->replaceSpace($stub);

        $files->put($path, $stub);
        $files->chmod($path, 0777);

        return $path;
    }

    public function preview($table, $name)
    {
        $name  = str_replace('/', '\\', $name);
        $files = app('files');
        $stub  = $files->get($this->stub);

        return $this->replaceClass($stub, $name)
            ->replaceTitle($stub)
            ->replaceNamespace($stub, $name)
            ->replaceSoftDeletes($stub)
            ->replaceTable($stub, $table, $name)
            ->replaceTimestamp($stub)
            ->replaceContent($stub)
            ->replacePrimaryKey($stub)
            ->replaceSpace($stub);
    }

    protected function replaceSoftDeletes(&$stub): static
    {
        $import = $use = '';

        if ($this->needSoftDelete) {
            $import = 'use Illuminate\\Database\\Eloquent\\SoftDeletes;';
            $use    = 'use SoftDeletes;';
        }

        $stub = str_replace(['{{ ImportSoftDelete }}', '{{ SoftDelete }}'], [$import, $use], $stub);

        return $this;
    }

    protected function replaceTable(&$stub, $table, $name): static
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        $tableName = Str::plural(strtolower($class)) !== $table ? "protected \$table = '$table';\n" : '';

        $stub = str_replace('{{ ModelTable }}', $tableName, $stub);

        return $this;
    }

    protected function replaceTimestamp(&$stub): static
    {
        $useTimestamps = $this->needTimestamp ? '' : "public \$timestamps = false;\n";

        $stub = str_replace('{{ Timestamp }}', $useTimestamps, $stub);

        return $this;
    }

    protected function replaceContent(&$stub): static
    {
        $content = '';

        $this->columns->each(function ($column) use (&$content) {
            if (Arr::get($column, 'file_column', false)) {
                $_name   = Str::camel($column['name']);
                $fun = 'file_upload_handle';
                if(Arr::get($column, 'file_column_multi', false)){
                    $fun = 'file_upload_handle_multi';
                }
                $content .= <<<EOF


    public function {$_name}():\Illuminate\Database\Eloquent\Casts\Attribute
    {
        return {$fun}();
    }
EOF;
            }
        });

        $stub = str_replace('{{ ModelContent }}', $content, $stub);

        return $this;
    }

    protected function replacePrimaryKey(&$stub): static
    {
        $modelKey = $this->primaryKey == 'id' ? '' : "protected \$primaryKey = '{$this->primaryKey}';\n";

        $stub = str_replace('{{ ModelKey }}', $modelKey, $stub);

        return $this;
    }
}
