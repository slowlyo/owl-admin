<?php

namespace Slowlyo\OwlAdmin\Support\CodeGenerator;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Slowlyo\OwlAdmin\Support\Cores\Module;
use Slowlyo\OwlAdmin\Controllers\AdminController;

class Generator
{
    public static array $dataTypeMap = [
        'int'                => 'integer',
        'int@unsigned'       => 'unsignedInteger',
        'tinyint'            => 'tinyInteger',
        'tinyint@unsigned'   => 'unsignedTinyInteger',
        'smallint'           => 'smallInteger',
        'smallint@unsigned'  => 'unsignedSmallInteger',
        'mediumint'          => 'mediumInteger',
        'mediumint@unsigned' => 'unsignedMediumInteger',
        'bigint'             => 'bigInteger',
        'bigint@unsigned'    => 'unsignedBigInteger',
        'date'               => 'date',
        'time'               => 'time',
        'datetime'           => 'dateTime',
        'timestamp'          => 'timestamp',
        'enum'               => 'enum',
        'json'               => 'json',
        'binary'             => 'binary',
        'float'              => 'float',
        'double'             => 'double',
        'decimal'            => 'decimal',
        'varchar'            => 'string',
        'char'               => 'char',
        'text'               => 'text',
        'mediumtext'         => 'mediumText',
        'longtext'           => 'longText',
    ];

    public static function make()
    {
        return new self();
    }

    public function needCreateOptions()
    {
        return [
            [
                'label' => __('admin.code_generators.create_database_migration'),
                'value' => 'need_database_migration',
            ],
            [
                'label' => __('admin.code_generators.create_table'),
                'value' => 'need_create_table',
            ],
            [
                'label' => __('admin.code_generators.create_model'),
                'value' => 'need_model',
            ],
            [
                'label' => __('admin.code_generators.create_controller'),
                'value' => 'need_controller',
            ],
            [
                'label' => __('admin.code_generators.create_service'),
                'value' => 'need_service',
            ],
        ];
    }

    public function availableFieldTypes(): array
    {
        return collect(self::$dataTypeMap)
            ->values()
            ->map(fn($value) => ['label' => $value, 'value' => $value])
            ->toArray();
    }

    public function getDatabaseColumns($db = null, $tb = null)
    {
        $databases = Arr::where(config('database.connections', []), function ($value) {
            $supports = ['mysql'];

            return in_array(strtolower(Arr::get($value, 'driver')), $supports);
        });

        $data = [];

        try {
            foreach ($databases as $connectName => $value) {
                if ($db && $db != $value['database']) continue;

                $sql = sprintf('SELECT * FROM information_schema.columns WHERE table_schema = "%s"',
                    $value['database']);

                if ($tb) {
                    $p = Arr::get($value, 'prefix');

                    $sql .= " AND TABLE_NAME = '{$p}{$tb}'";
                }

                $sql .= ' ORDER BY `ORDINAL_POSITION` ASC';

                $tmp = DB::connection($connectName)->select($sql);

                $collection = collect($tmp)->map(function ($v) use ($value) {
                    if (!$p = Arr::get($value, 'prefix')) {
                        return (array)$v;
                    }
                    $v = (array)$v;

                    $v['TABLE_NAME'] = Str::replaceFirst($p, '', $v['TABLE_NAME']);

                    return $v;
                });

                $data[$value['database']] = $collection->groupBy('TABLE_NAME')->map(function ($v) {
                    return collect($v)
                        ->keyBy('COLUMN_NAME')
                        ->where('COLUMN_KEY', '<>', 'PRI')
                        ->whereNotIn('COLUMN_NAME', ['created_at', 'updated_at', 'deleted_at'])
                        ->map(function ($v) {
                            $v['COLUMN_TYPE'] = strtolower($v['COLUMN_TYPE']);
                            $v['DATA_TYPE']   = strtolower($v['DATA_TYPE']);

                            if (Str::contains($v['COLUMN_TYPE'], 'unsigned')) {
                                $v['DATA_TYPE'] .= '@unsigned';
                            }


                            return [
                                'name'     => $v['COLUMN_NAME'],
                                'type'     => Arr::get(Generator::$dataTypeMap, $v['DATA_TYPE'], 'string'),
                                'default'  => $v['COLUMN_DEFAULT'],
                                'nullable' => $v['IS_NULLABLE'] == 'YES',
                                'comment'  => $v['COLUMN_COMMENT'],
                            ];
                        })
                        ->values();
                });
            }
        } catch (\Throwable $e) {
        }

        return collect($data);
    }

    public function getDatabasePrimaryKeys($db = null, $tb = null)
    {
        $databases = Arr::where(config('database.connections', []), function ($value) {
            $supports = ['mysql'];

            return in_array(strtolower(Arr::get($value, 'driver')), $supports);
        });

        $data = [];

        try {
            foreach ($databases as $connectName => $value) {
                if ($db && $db != $value['database']) continue;

                $sql = sprintf('SELECT * FROM information_schema.columns WHERE table_schema = "%s"',
                    $value['database']);

                if ($tb) {
                    $p = Arr::get($value, 'prefix');

                    $sql .= " AND TABLE_NAME = '{$p}{$tb}'";
                }

                $tmp = DB::connection($connectName)->select($sql);

                $collection = collect($tmp)->map(function ($v) use ($value) {
                    if (!$p = Arr::get($value, 'prefix')) {
                        return (array)$v;
                    }
                    $v = (array)$v;

                    $v['TABLE_NAME'] = Str::replaceFirst($p, '', $v['TABLE_NAME']);

                    return $v;
                });

                $data[$value['database']] = $collection->groupBy('TABLE_NAME')->map(function ($v) {
                    return collect($v)
                        ->keyBy('COLUMN_NAME')
                        ->where('COLUMN_KEY', 'PRI')
                        ->whereNotIn('COLUMN_NAME', ['created_at', 'updated_at', 'deleted_at'])
                        ->map(fn($v) => $v['COLUMN_NAME'])
                        ->values()
                        ->first();
                });
            }
        } catch (\Throwable $e) {
        }

        return collect($data);
    }

    public function getAllChildController()
    {
        $dirs = [app_path()];

        if (Module::installed()) {
            $dirs[] = config('modules.paths.modules');
        }

        foreach ($dirs as $dir) {
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
            $phpFiles = new \RegexIterator($iterator, '/^.+\Controller.php$/i', \RegexIterator::GET_MATCH);

            foreach ($phpFiles as $phpFile) {
                $filePath = $phpFile[0];
                require_once $filePath;
            }
        }

        return collect(get_declared_classes())
            ->filter(fn($item) => (new \ReflectionClass($item))->isSubclassOf(AdminController::class))
            ->values()
            ->toArray();
    }
}
