<?php

namespace Slowlyo\OwlAdmin\Support\CodeGenerator;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Models\AdminCodeGenerator;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Database\Migrations\MigrationCreator as BaseMigrationCreator;
use Slowlyo\OwlAdmin\Support\Cores\Database;

class MigrationGenerator extends BaseMigrationCreator
{
    protected AdminCodeGenerator $model;

    public function __construct($model)
    {
        $this->model = $model;

        parent::__construct(app('files'), __DIR__ . '/stubs');
    }

    public static function make($model): static
    {
        return new self($model);
    }

    public function generate(): string
    {
        $name = 'create_' . $this->model->table_name . '_table';
        $path = BaseGenerator::guessClassFileName($this->model->model_name);

        if (Admin::currentModule()) {
            $path = str_replace('/Models/', '/database/migrations/', $path);
        } else {
            $path = database_path('migrations') . '/temp.php';
        }

        return $this->create($name, dirname($path), $this->model->table_name, null);
    }

    protected function populateStub($stub, $table): array|string
    {
        return str_replace(['{{ content }}', '{{ table }}'], [$this->generateContent(), $table], $stub);
    }

    public function preview()
    {
        return $this->populateStub($this->getStub($this->model->table_name, false), $this->model->table_name);
    }

    public function generateContent(): string
    {
        blank($this->model->columns) && abort(HttpResponse::HTTP_BAD_REQUEST, 'Table fields can\'t be empty');

        $rows   = [];
        $rows[] = "\$table->comment('{$this->model->title}');\n";
        $rows[] = "\$table->increments('{$this->model->primary_key}');\n";

        foreach ($this->model->columns as $field) {
            $additional = Arr::get($field, 'additional');

            $column = "\$table->{$field['type']}('{$field['name']}'";
            if ($additional && $additional != '') {
                $column .= ', ' . $additional;
            }
            $column .= ')';

            $column_index = Arr::get($field, 'column_index');
            if ($column_index) {
                $column .= "->{$column_index}()";
            }

            $hasDefault = isset($field['default']) && $field['default'] !== '';
            if ($hasDefault) {
                $default = "'{$field['default']}'";

                if (is_numeric($field['default'])) {
                    $default = "new \Illuminate\Database\Query\Expression({$default})";
                }

                $column .= "->default({$default})";
            }

            if (Arr::get($field, 'nullable', false)) {
                $column .= '->nullable()';
            } else if (!$hasDefault && $field['type'] === 'string') {
                $column .= "->default('')";
            }

            if (isset($field['comment']) && $field['comment']) {
                $column .= "->comment('{$field['comment']}')";
            }

            $rows[] = $column . ";\n";
        }

        if ($this->model->need_timestamps) {
            $rows[] = "\$table->timestamps();\n";
        }

        if ($this->model->soft_delete) {
            $rows[] = "\$table->softDeletes();\n";
        }

        return trim(implode(str_repeat(' ', 12), $rows), "\n");
    }

    protected function getStub($table, $create): string
    {
        $stub = $this->files->exists($customPath = $this->customStubPath . '/migration.stub')
            ? $customPath
            : $this->stubPath() . '/migration.stub';

        return $this->files->get($stub);
    }

    public function stubPath(): string
    {
        return __DIR__ . '/stubs';
    }
}
