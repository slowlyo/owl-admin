<?php

namespace Slowlyo\OwlAdmin\Support\CodeGenerator;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Slowlyo\OwlAdmin\Traits\MakeTrait;
use Illuminate\Support\Facades\Artisan;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Models\AdminCodeGenerator;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class Generator
{
    use MakeTrait;

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
        'integer'            => 'integer',
    ];

    public function needCreateOptions()
    {
        return [
            [
                'label' => admin_trans('admin.code_generators.create_database_migration'),
                'value' => 'need_database_migration',
            ],
            [
                'label' => admin_trans('admin.code_generators.create_table'),
                'value' => 'need_create_table',
            ],
            [
                'label' => admin_trans('admin.code_generators.create_model'),
                'value' => 'need_model',
            ],
            [
                'label' => admin_trans('admin.code_generators.create_controller'),
                'value' => 'need_controller',
            ],
            [
                'label' => admin_trans('admin.code_generators.create_service'),
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

    /**
     * 获取数据库表字段信息 (使用DB和PDO实现，优化查询效率)
     *
     * @param string|null $db 数据库名
     * @return \Illuminate\Support\Collection
     */
    public function getDatabaseColumns($db = null)
    {
        // 获取所有支持的数据库连接
        $databases = Arr::where(Admin::config('admin.database.generator') ?: [config("database.default")], function ($value) {
            $supports = ['mysql', 'sqlite', 'pgsql'];
            return in_array(strtolower(Arr::get($value, 'driver')), $supports);
        });

        $data = [];

        try {
            foreach ($databases as $connectName => $value) {
                // 如果指定了数据库名且不匹配当前连接，则跳过
                if ($db && $db != $value['database']) continue;

                try {
                    // 获取数据库连接
                    $connection = DB::connection($connectName);
                    $pdo = $connection->getPdo();
                    $database = $value['database'];
                    $prefix = $value['prefix'] ?? '';
                    
                    // 键(database名称)长度超过28个字符 amis 会获取字段信息失败(sqlite)，截取一下
                    $databaseKey = strlen($database) > 28 ? substr_replace($database, '***', 10, -15) : $database;
                    $data[$databaseKey] = [];
                    
                    // 根据数据库类型选择不同的查询方式
                    switch(strtolower($value['driver'])) {
                        case 'mysql':
                            // MySQL: 使用information_schema一次性获取所有表的所有字段
                            $sql = "SELECT 
                                    TABLE_NAME, 
                                    COLUMN_NAME, 
                                    DATA_TYPE, 
                                    COLUMN_TYPE,
                                    COLLATION_NAME, 
                                    IS_NULLABLE, 
                                    COLUMN_DEFAULT, 
                                    EXTRA, 
                                    COLUMN_COMMENT
                                FROM information_schema.columns 
                                WHERE TABLE_SCHEMA = '{$database}'";

                            $allColumns = $pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
                            
                            // 按表名分组
                            $columnsByTable = [];
                            foreach ($allColumns as $column) {
                                $tableName = $column['TABLE_NAME'];
                                
                                // 移除表前缀
                                $tableNameWithoutPrefix = Str::replaceFirst($prefix, '', $tableName);
                                
                                if (!isset($columnsByTable[$tableNameWithoutPrefix])) {
                                    $columnsByTable[$tableNameWithoutPrefix] = [];
                                }
                                
                                // 跳过id、时间戳等字段
                                if (in_array($column['COLUMN_NAME'], ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                                    continue;
                                }
                                
                                // 从COLUMN_TYPE中提取类型名称
                                preg_match('/^([a-z]+)(\(.*\))?/', $column['COLUMN_TYPE'], $matches);
                                $typeName = $matches[1] ?? $column['DATA_TYPE'];
                                
                                // 获取对应的PHP类型
                                $type = Arr::get(self::$dataTypeMap, $typeName, 'string');
                                
                                $columnsByTable[$tableNameWithoutPrefix][] = [
                                    'name' => $column['COLUMN_NAME'],
                                    'type_name' => $typeName,
                                    'type' => $type,
                                    'collation' => $column['COLLATION_NAME'],
                                    'nullable' => $column['IS_NULLABLE'] === 'YES',
                                    'default' => $column['COLUMN_DEFAULT'],
                                    'auto_increment' => strpos($column['EXTRA'], 'auto_increment') !== false,
                                    'comment' => $column['COLUMN_COMMENT'] ?: Str::studly($column['COLUMN_NAME']),
                                    'generation' => null,
                                ];
                            }
                            
                            $data[$databaseKey] = $columnsByTable;
                            break;
                            
                        case 'sqlite':
                            // SQLite: 先获取所有表，然后批量查询每个表的结构
                            $tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table';")->fetchAll(\PDO::FETCH_COLUMN);
                            
                            // 移除表前缀
                            $tables = array_map(function($tableName) use ($prefix) {
                                return Str::replaceFirst($prefix, '', $tableName);
                            }, $tables);
                            
                            foreach ($tables as $table) {
                                $stmt = $pdo->prepare("PRAGMA table_info(`{$table}`)");
                                $stmt->execute();
                                $columns = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                                
                                $fields = [];
                                foreach ($columns as $column) {
                                    // 跳过id、时间戳等字段
                                    if (in_array($column['name'], ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                                        continue;
                                    }
                                    
                                    // SQLite类型映射
                                    $typeName = strtolower($column['type']);
                                    $type = match(true) {
                                        str_contains($typeName, 'int') => 'integer',
                                        str_contains($typeName, 'char') || str_contains($typeName, 'text') => 'string',
                                        str_contains($typeName, 'real') || str_contains($typeName, 'floa') || str_contains($typeName, 'doub') => 'float',
                                        str_contains($typeName, 'blob') => 'binary',
                                        default => 'string',
                                    };
                                    
                                    $fields[] = [
                                        'name' => $column['name'],
                                        'type_name' => $typeName,
                                        'type' => $type,
                                        'collation' => null,
                                        'nullable' => !$column['notnull'],
                                        'default' => $column['dflt_value'],
                                        'auto_increment' => false, // SQLite使用ROWID自增，不在字段属性中显示
                                        'comment' => Str::studly($column['name']),
                                        'generation' => null,
                                    ];
                                }
                                
                                if (!empty($fields)) {
                                    $data[$databaseKey][$table] = $fields;
                                }
                            }
                            break;
                            
                        case 'pgsql':
                            // PostgreSQL: 一次性获取所有表的所有字段
                            $sql = "
                                SELECT 
                                    t.tablename AS table_name,
                                    a.attname AS column_name,
                                    format_type(a.atttypid, a.atttypmod) AS data_type,
                                    a.attnotnull AS not_null,
                                    pg_get_expr(d.adbin, d.adrelid) AS default_value,
                                    col_description(a.attrelid, a.attnum) AS comment
                                FROM pg_catalog.pg_attribute a
                                JOIN pg_catalog.pg_class c ON a.attrelid = c.oid
                                JOIN pg_catalog.pg_namespace n ON c.relnamespace = n.oid
                                JOIN pg_catalog.pg_tables t ON c.relname = t.tablename AND n.nspname = t.schemaname
                                LEFT JOIN pg_catalog.pg_attrdef d ON a.attrelid = d.adrelid AND a.attnum = d.adnum
                                WHERE a.attnum > 0
                                AND NOT a.attisdropped
                                AND n.nspname = 'public'
                            ";
                            
                            $allColumns = $pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
                            
                            // 按表名分组
                            $columnsByTable = [];
                            foreach ($allColumns as $column) {
                                $tableName = $column['table_name'];
                                
                                // 移除表前缀
                                $tableNameWithoutPrefix = Str::replaceFirst($prefix, '', $tableName);
                                
                                if (!isset($columnsByTable[$tableNameWithoutPrefix])) {
                                    $columnsByTable[$tableNameWithoutPrefix] = [];
                                }
                                
                                // 跳过id、时间戳等字段
                                if (in_array($column['column_name'], ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                                    continue;
                                }
                                
                                // PostgreSQL类型映射
                                $typeName = $column['data_type'];
                                $type = match(true) {
                                    str_contains($typeName, 'int') => 'integer',
                                    str_contains($typeName, 'char') || str_contains($typeName, 'text') => 'string',
                                    str_contains($typeName, 'float') || str_contains($typeName, 'double') || str_contains($typeName, 'numeric') => 'float',
                                    str_contains($typeName, 'bool') => 'boolean',
                                    str_contains($typeName, 'timestamp') || str_contains($typeName, 'date') => 'date',
                                    str_contains($typeName, 'json') => 'json',
                                    str_contains($typeName, 'bytea') => 'binary',
                                    default => 'string',
                                };
                                
                                $columnsByTable[$tableNameWithoutPrefix][] = [
                                    'name' => $column['column_name'],
                                    'type_name' => $typeName,
                                    'type' => $type,
                                    'collation' => null,
                                    'nullable' => !$column['not_null'],
                                    'default' => $column['default_value'],
                                    'auto_increment' => strpos($column['default_value'] ?? '', 'nextval') !== false,
                                    'comment' => $column['comment'] ?: Str::studly($column['column_name']),
                                    'generation' => null,
                                ];
                            }
                            
                            $data[$databaseKey] = $columnsByTable;
                            break;
                    }
                } catch (\Throwable $e) {
                    // 连不上的跳过
                    continue;
                }
            }
        } catch (\Throwable $e) {
            // 出错时返回空集合
        }

        return collect($data);
    }

    public function getDatabasePrimaryKeys($db = null, $tb = null)
    {
        $databases = Arr::where(Admin::config('admin.database.generator') ?: [config("database.default")], function ($value) {
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

    public function generate($id, $needs = [])
    {
        $record = AdminCodeGenerator::find($id);
        $model  = AdminCodeGenerator::find($id);
        $needs  = collect(filled($needs) ? $needs : $record->needs);

        $successMessage = fn($type, $path) => "<b class='text-success'>{$type} generated successfully!</b><br>{$path}<br><br>";

        $paths   = [];
        $message = '';
        try {
            // Model
            if ($needs->contains('need_model')) {
                $path = ModelGenerator::make($model)->generate();

                $message .= $successMessage('Model', $path);
                $paths[] = $path;
            }

            // Controller
            if ($needs->contains('need_controller')) {
                $path = ControllerGenerator::make($record)->generate();

                $message .= $successMessage('Controller', $path);
                $paths[] = $path;
            }

            // Service
            if ($needs->contains('need_service')) {
                $path = ServiceGenerator::make($record)->generate();

                $message .= $successMessage('Service', $path);
                $paths[] = $path;
            }

            // Route
            RouteGenerator::handle($record->menu_info);

            // Migration
            $migratePath = '';
            if ($needs->contains('need_database_migration')) {
                $path = MigrationGenerator::make($record)->generate();

                $message     .= $successMessage('Migration', $path);
                $migratePath = str_replace(base_path(), '', $path);
                $paths[]     = $path;
            }

            // 创建数据库表
            if ($needs->contains('need_create_table')) {
                if (Admin::hasTable($record->table_name)) {
                    abort(HttpResponse::HTTP_BAD_REQUEST, "Table [{$record->table_name}] already exists!");
                }

                if ($migratePath) {
                    Artisan::call('migrate', ['--path' => $migratePath]);
                } else {
                    Artisan::call('migrate');
                }
                $message .= $successMessage('Table', Artisan::output());
            }
        } catch (\Throwable $e) {
            app('files')->delete($paths);

            RouteGenerator::refresh();

            admin_abort($e->getMessage());
        }

        return $message;
    }

    public function preview($id)
    {
        $record = AdminCodeGenerator::find($id);

        try {
            // Model
            $model = ModelGenerator::make($record)->preview();
            // Migration
            $migration = MigrationGenerator::make($record)->preview();
            // Controller
            $controller = ControllerGenerator::make($record)->preview();
            // Service
            $service = ServiceGenerator::make($record)->preview();
        } catch (\Exception $e) {
            admin_abort($e->getMessage());
        }

        return compact('model', 'migration', 'controller', 'service');
    }
}
