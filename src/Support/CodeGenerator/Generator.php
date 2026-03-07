<?php

namespace Slowlyo\OwlAdmin\Support\CodeGenerator;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PDO;
use Throwable;
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

    /**
     * 获取代码生成可创建项。
     *
     * @return array
     */
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

    /**
     * 获取可选字段类型。
     *
     * @return array
     */
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
        // 统一复用生成器支持的连接配置，避免多处筛选逻辑漂移。
        $databases = $this->getSupportedGeneratorConnections();

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
                    
                    // 统一数据库键名，避免长库名时字段和主键映射不一致。
                    $databaseKey = $this->resolveDatabaseKey($value);
                    $data[$databaseKey] = [];
                    
                    // 根据数据库类型选择不同的查询方式
                    switch (strtolower($value['driver'])) {
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

                            $allColumns = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                            
                            // 按表名分组
                            $columnsByTable = [];
                            foreach ($allColumns as $column) {
                                $tableName = $column['TABLE_NAME'];
                                
                                // 移除表前缀
                                $tableNameWithoutPrefix = $this->normalizeTableName($tableName, $prefix);
                                
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
                            $tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table';")->fetchAll(PDO::FETCH_COLUMN);
                            
                            // 移除表前缀
                            $tables = array_map(function ($tableName) use ($prefix) {
                                return $this->normalizeTableName($tableName, $prefix);
                            }, $tables);
                            
                            foreach ($tables as $table) {
                                $stmt = $pdo->prepare("PRAGMA table_info(`{$table}`)");
                                $stmt->execute();
                                $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
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
                            
                            $allColumns = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                            
                            // 按表名分组
                            $columnsByTable = [];
                            foreach ($allColumns as $column) {
                                $tableName = $column['table_name'];
                                
                                // 移除表前缀
                                $tableNameWithoutPrefix = $this->normalizeTableName($tableName, $prefix);
                                
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
                } catch (Throwable $e) {
                    // 连不上的跳过
                    continue;
                }
            }
        } catch (Throwable $e) {
            // 出错时返回空集合
        }

        return collect($data);
    }

    /**
     * 获取数据库表主键信息。
     *
     * @param string|null $db 数据库名
     * @param string|null $tb 表名
     * @return Collection
     */
    public function getDatabasePrimaryKeys($db = null, $tb = null)
    {
        $databases = $this->getSupportedGeneratorConnections();

        $data = [];

        try {
            foreach ($databases as $connectName => $value) {
                // 指定数据库时只返回目标连接，避免多余查询。
                if ($db && $db != $value['database']) {
                    continue;
                }

                $databaseKey = $this->resolveDatabaseKey($value);
                $data[$databaseKey] = $this->queryPrimaryKeysByDriver($connectName, $value, $tb);
            }
        } catch (Throwable $e) {
        }

        return collect($data);
    }

    /**
     * 按所选内容生成代码并按需执行建表。
     *
     * @param mixed $id
     * @param array $needs
     *
     * @return string
     */
    public function generate($id, $needs = [])
    {
        $record = AdminCodeGenerator::query()->find($id);

        // 生成依赖记录完整存在，缺失时直接返回 404，避免后续空对象报错。
        if (!$record) {
            abort(HttpResponse::HTTP_NOT_FOUND, 'Code generator record not found!');
        }

        $needs  = collect(filled($needs) ? $needs : $record->needs);

        if ($needs->contains('need_create_table')) {
            $needs = $needs->push('need_database_migration')->unique()->values();
        }

        $successMessage = fn($type, $path) => "<b class='text-success'>{$type} generated successfully!</b><br>{$path}<br><br>";

        $paths   = [];
        $message = '';
        try {
            // Model
            if ($needs->contains('need_model')) {
                $path = ModelGenerator::make($record)->generate();

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
                $migratePath = $path;
                $paths[]     = $path;
            }

            // 创建数据库表
            if ($needs->contains('need_create_table')) {
                if (Admin::hasTable($record->table_name)) {
                    abort(HttpResponse::HTTP_BAD_REQUEST, "Table [{$record->table_name}] already exists!");
                }

                // 建表必须绑定本次迁移文件，避免误触发全量迁移。
                if (blank($migratePath)) {
                    abort(HttpResponse::HTTP_BAD_REQUEST, "Migration file for [{$record->table_name}] is required before creating table!");
                }

                Artisan::call('migrate', ['--path' => $migratePath, '--realpath' => true]);

                $message .= $successMessage('Table', Artisan::output());
            }
        } catch (Throwable $e) {
            app('files')->delete($paths);

            RouteGenerator::refresh();

            admin_abort($e->getMessage());
        }

        return $message;
    }

    /**
     * 预览即将生成的代码内容。
     *
     * @param mixed $id
     * @return array
     */
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
        } catch (Exception $e) {
            admin_abort($e->getMessage());
        }

        return compact('model', 'migration', 'controller', 'service');
    }

    /**
     * 获取代码生成支持的数据库连接。
     *
     * @return array
     */
    protected function getSupportedGeneratorConnections(): array
    {
        return Arr::where(config('database.connections', []), function ($value, $connectName) {
            $supports = Admin::config('admin.database.generator') ?: [config('database.default')];

            return in_array($connectName, $supports);
        });
    }

    /**
     * 统一数据库键名。
     *
     * @param array $connection
     * @return string
     */
    protected function resolveDatabaseKey(array $connection): string
    {
        $database = $connection['database'] ?? '';

        // 长库名会导致前端联动失败，这里统一截断规则。
        if (strlen($database) > 28) {
            return substr_replace($database, '***', 10, -15);
        }

        return $database;
    }

    /**
     * 归一化表名，移除配置前缀。
     *
     * @param string $tableName
     * @param string $prefix
     * @return string
     */
    protected function normalizeTableName(string $tableName, string $prefix = ''): string
    {
        // 未配置前缀时直接返回原表名。
        if (blank($prefix)) {
            return $tableName;
        }

        return Str::replaceFirst($prefix, '', $tableName);
    }

    /**
     * 按驱动查询数据库主键。
     *
     * @param string $connectName
     * @param array $connection
     * @param string|null $table
     * @return Collection
     */
    protected function queryPrimaryKeysByDriver(string $connectName, array $connection, $table = null): Collection
    {
        $driver = strtolower($connection['driver'] ?? '');

        return match ($driver) {
            'mysql' => $this->queryMysqlPrimaryKeys($connectName, $connection, $table),
            'sqlite' => $this->querySqlitePrimaryKeys($connectName, $connection, $table),
            'pgsql' => $this->queryPgsqlPrimaryKeys($connectName, $connection, $table),
            default => collect(),
        };
    }

    /**
     * 查询 MySQL 主键。
     *
     * @param string $connectName
     * @param array $connection
     * @param string|null $table
     * @return Collection
     */
    protected function queryMysqlPrimaryKeys(string $connectName, array $connection, $table = null): Collection
    {
        $sql = 'SELECT TABLE_NAME AS table_name, COLUMN_NAME AS column_name, ORDINAL_POSITION AS ordinal_position '
            . 'FROM information_schema.KEY_COLUMN_USAGE '
            . 'WHERE TABLE_SCHEMA = ? AND CONSTRAINT_NAME = ?';
        $bindings = [$connection['database'], 'PRIMARY'];

        // 指定表时只查询目标表，减少 information_schema 扫描范围。
        if ($table) {
            $sql .= ' AND TABLE_NAME = ?';
            $bindings[] = ($connection['prefix'] ?? '') . $table;
        }

        $sql .= ' ORDER BY TABLE_NAME, ORDINAL_POSITION';

        return $this->formatPrimaryKeys(DB::connection($connectName)->select($sql, $bindings), $connection);
    }

    /**
     * 查询 SQLite 主键。
     *
     * @param string $connectName
     * @param array $connection
     * @param string|null $table
     * @return Collection
     */
    protected function querySqlitePrimaryKeys(string $connectName, array $connection, $table = null): Collection
    {
        $sql = "SELECT m.name AS table_name, p.name AS column_name, p.pk AS ordinal_position "
            . "FROM sqlite_master AS m "
            . "JOIN pragma_table_info(m.name) AS p "
            . "WHERE m.type = 'table' AND m.name NOT LIKE 'sqlite_%' AND p.pk > 0";
        $bindings = [];

        // 指定表时收敛到单表，兼容复合主键顺序读取。
        if ($table) {
            $sql .= ' AND m.name = ?';
            $bindings[] = ($connection['prefix'] ?? '') . $table;
        }

        $sql .= ' ORDER BY m.name, p.pk';

        try {
            return $this->formatPrimaryKeys(DB::connection($connectName)->select($sql, $bindings), $connection);
        } catch (Throwable $e) {
            // 老版本 SQLite 不支持表值 PRAGMA 时，降级为逐表读取。
            return $this->querySqlitePrimaryKeysFallback($connectName, $connection, $table);
        }
    }

    /**
     * 查询 PostgreSQL 主键。
     *
     * @param string $connectName
     * @param array $connection
     * @param string|null $table
     * @return Collection
     */
    protected function queryPgsqlPrimaryKeys(string $connectName, array $connection, $table = null): Collection
    {
        $sql = "SELECT cls.relname AS table_name, attr.attname AS column_name, pos.n AS ordinal_position "
            . "FROM pg_constraint AS con "
            . "JOIN pg_class AS cls ON cls.oid = con.conrelid "
            . "JOIN pg_namespace AS ns ON ns.oid = cls.relnamespace "
            . "JOIN unnest(con.conkey) WITH ORDINALITY AS pos(attnum, n) ON TRUE "
            . "JOIN pg_attribute AS attr ON attr.attrelid = cls.oid AND attr.attnum = pos.attnum "
            . "WHERE con.contype = 'p' AND ns.nspname = 'public'";
        $bindings = [];

        // 指定表时只查当前表，避免全库扫描。
        if ($table) {
            $sql .= ' AND cls.relname = ?';
            $bindings[] = ($connection['prefix'] ?? '') . $table;
        }

        $sql .= ' ORDER BY cls.relname, pos.n';

        return $this->formatPrimaryKeys(DB::connection($connectName)->select($sql, $bindings), $connection);
    }

    /**
     * 规范化主键查询结果。
     *
     * @param array $rows
     * @param array $connection
     * @return Collection
     */
    protected function formatPrimaryKeys(array $rows, array $connection): Collection
    {
        $prefix = $connection['prefix'] ?? '';

        return collect($rows)
            ->map(function ($row) use ($prefix) {
                $item = (array) $row;

                return [
                    'table_name' => $this->normalizeTableName($item['table_name'], $prefix),
                    'column_name' => $item['column_name'],
                    'ordinal_position' => (int) $item['ordinal_position'],
                ];
            })
            ->groupBy('table_name')
            ->map(function (Collection $items) {
                $primaryKeys = $items
                    ->sortBy('ordinal_position')
                    ->pluck('column_name')
                    ->reject(fn($column) => in_array($column, ['created_at', 'updated_at', 'deleted_at']))
                    ->values();

                // 兼容现有文本字段，同时保留复合主键顺序。
                return $primaryKeys->implode(',');
            });
    }

    /**
     * 兼容低版本 SQLite 的主键查询。
     *
     * @param string $connectName
     * @param array $connection
     * @param string|null $table
     * @return Collection
     */
    protected function querySqlitePrimaryKeysFallback(string $connectName, array $connection, $table = null): Collection
    {
        $sql = "SELECT name FROM sqlite_master WHERE type = 'table' AND name NOT LIKE 'sqlite_%'";
        $bindings = [];

        // 指定表时只读取目标表，避免回退逻辑放大扫描范围。
        if ($table) {
            $sql .= ' AND name = ?';
            $bindings[] = ($connection['prefix'] ?? '') . $table;
        }

        $tables = DB::connection($connectName)->select($sql, $bindings);
        $rows = [];

        foreach ($tables as $tableItem) {
            $tableName = data_get((array) $tableItem, 'name');

            // 表名由 sqlite_master 返回，仅做转义后拼入 PRAGMA。
            $pragmaTableName = str_replace('"', '""', $tableName);
            $columns = DB::connection($connectName)->select("PRAGMA table_info(\"{$pragmaTableName}\")");

            foreach ($columns as $column) {
                $column = (array) $column;

                // 只有 pk 序号大于 0 的字段才属于主键，且要保留复合主键顺序。
                if (($column['pk'] ?? 0) < 1) {
                    continue;
                }

                $rows[] = [
                    'table_name' => $tableName,
                    'column_name' => $column['name'],
                    'ordinal_position' => (int) $column['pk'],
                ];
            }
        }

        return $this->formatPrimaryKeys($rows, $connection);
    }
}
