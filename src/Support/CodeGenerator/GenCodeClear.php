<?php

namespace Slowlyo\OwlAdmin\Support\CodeGenerator;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Traits\MakeTrait;
use Illuminate\Support\Facades\Schema;
use Slowlyo\OwlAdmin\Models\AdminCodeGenerator;

class GenCodeClear
{
    use MakeTrait;

    protected string $module = '';

    public function handle($data)
    {
        $records  = $this->getRecord($data['id']);
        $selected = explode(',', $data['selected']);

        if (in_array('controller', $selected)) {
            @unlink($records['controller']);
        }

        if (in_array('model', $selected)) {
            @unlink($records['model']);
        }

        if (in_array('service', $selected)) {
            @unlink($records['service']);
        }

        if (in_array('migration', $selected)) {
            @unlink($records['migration']);
        }

        if (in_array('table', $selected)) {
            Schema::dropIfExists($records['table']);
        }

        if (in_array('menu', $selected)) {
            Admin::adminMenuModel()::where('id', $records['menu_id'])->delete();
        }
    }

    public function getRecord($id)
    {
        $record = AdminCodeGenerator::find($id);

        $arr = explode('/', $record->model_name);

        if ($arr[0] == Admin::module()->namespace) {
            $this->module = $arr[1];
        }

        $controllerPath = BaseGenerator::guessClassFileName(str_replace('/', '\\', $record->controller_name));
        $modelPath      = BaseGenerator::guessClassFileName(str_replace('/', '\\', $record->model_name));
        $servicePath    = BaseGenerator::guessClassFileName(str_replace('/', '\\', $record->service_name));
        $tableName      = $record->table_name;
        $migrationPath  = $this->getMigrationFileName($tableName, $record->model_name);
        $menuRecord     = $this->getMenu($record->menu_info);

        $checkFile = fn($path) => file_exists($path) ? $path : '';

        $content = [
            'controller' => $checkFile($controllerPath),
            'model'      => $checkFile($modelPath),
            'service'    => $checkFile($servicePath),
            'migration'  => $checkFile($migrationPath),
            'table'      => Schema::hasTable($tableName) ? $tableName : '',
        ];

        if ($menuRecord) {
            $content['menu']    = sprintf('[%s] %s(%s)', $menuRecord->id, $menuRecord->title, $menuRecord->url);
            $content['menu_id'] = $menuRecord->id;
        }

        return $content;
    }

    protected function getMigrationFileName($tableName, $model_name)
    {
        $tableName = 'create_' . $tableName . '_table';

        $migrationPath = BaseGenerator::guessClassFileName($model_name);
        if ($this->module) {
            $migrationPath = str_replace('/Models/', '/database/migrations/', $migrationPath);
        } else {
            $migrationPath = str_replace('/Models/', '/../database/migrations/', $migrationPath);
        }
        $migrationPath = dirname($migrationPath);

        if (!is_dir($migrationPath)) {
            return '';
        }
        $files = scandir($migrationPath);

        $files = array_filter($files, fn($file) => str_contains($file, $tableName));

        if (count($files) > 1) {
            return '';
        }

        if (count($files) == 0) {
            return '';
        }

        $files = array_values($files);

        return realpath($migrationPath . '/' . $files[0]);
    }

    protected function getMenu($menuInfo)
    {
        $where = [
            'title'     => $menuInfo['title'],
            'parent_id' => $menuInfo['parent_id'],
            'url'       => '/' . ltrim($menuInfo['route'], '/'),
        ];

        if ($this->module) {
            $menuModel = config(Admin::module()->getLowerName($this->module) . '.admin.models.admin_menu');

            if (class_exists($menuModel)) {
                return $menuModel::query()->where($where)->first();
            }
        }

        return Admin::adminMenuModel()::query()->where($where)->first();
    }
}
