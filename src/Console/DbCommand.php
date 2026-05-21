<?php

namespace Slowlyo\OwlAdmin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Slowlyo\OwlAdmin\Admin;
use Throwable;

class DbCommand extends Command
{
    protected $signature = 'admin:db
        {action=info : info|tables|columns|query}
        {target? : 表名或只读 SQL}
        {--connection= : 指定数据库连接}
        {--limit=50 : query 最大返回行数}';

    protected $description = 'Inspect the database connection used by OwlAdmin.';

    /**
     * 执行数据库巡检命令，只提供只读能力，避免 CLI 误操作业务数据。
     */
    public function handle(): int
    {
        $action = $this->argument('action');

        try {
            return match ($action) {
                'info'    => $this->showInfo(),
                'tables'  => $this->showTables(),
                'columns' => $this->showColumns(),
                'query'   => $this->runReadOnlyQuery(),
                default   => $this->failAction($action),
            };
        } catch (Throwable $e) {
            // 数据库命令常用于排障，连接异常直接给出摘要，避免终端刷出框架堆栈。
            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }

    /**
     * 输出当前 OwlAdmin 使用的数据库连接信息，用于确认命令操作范围。
     */
    protected function showInfo(): int
    {
        $connection = $this->connectionName();
        $config = config("database.connections.{$connection}", []);

        $this->table([admin_trans('admin.console.table_item'), admin_trans('admin.console.table_value')], [
            ['connection', $connection],
            ['driver', $config['driver'] ?? ''],
            ['host', $config['host'] ?? ''],
            ['port', $config['port'] ?? ''],
            ['database', $config['database'] ?? ''],
            ['prefix', $config['prefix'] ?? ''],
        ]);

        return self::SUCCESS;
    }

    /**
     * 输出当前连接下的表清单，优先使用 Laravel Schema 以兼容多数据库驱动。
     */
    protected function showTables(): int
    {
        $tables = collect(Schema::connection($this->connectionName())->getTables())
            ->map(fn($table) => $table['name'] ?? $table['schema_qualified_name'] ?? reset($table))
            ->filter()
            ->values()
            ->map(fn($table) => [$table])
            ->all();

        $this->table([admin_trans('admin.console.table_table')], $tables);

        return self::SUCCESS;
    }

    /**
     * 输出指定表字段结构，用于快速确认菜单、权限等系统表字段。
     */
    protected function showColumns(): int
    {
        $table = $this->argument('target');

        if (blank($table)) {
            $this->error(admin_trans('admin.console.db_table_required'));

            return self::FAILURE;
        }

        $columns = collect(Schema::connection($this->connectionName())->getColumns($table))
            ->map(fn($column) => [
                $column['name'] ?? '',
                $column['type_name'] ?? $column['type'] ?? '',
                $column['nullable'] ?? '',
                $column['default'] ?? '',
            ])
            ->all();

        $this->table([
            admin_trans('admin.console.table_column'),
            admin_trans('admin.console.table_type'),
            admin_trans('admin.console.table_nullable'),
            admin_trans('admin.console.table_default'),
        ], $columns);

        return self::SUCCESS;
    }

    /**
     * 执行只读 SQL，并自动追加 limit，防止误跑大结果集拖慢终端。
     */
    protected function runReadOnlyQuery(): int
    {
        $sql = trim((string)$this->argument('target'));

        if (blank($sql)) {
            $this->error(admin_trans('admin.console.db_query_required'));

            return self::FAILURE;
        }

        if (!$this->isReadOnlySql($sql)) {
            $this->error(admin_trans('admin.console.db_readonly_only'));

            return self::FAILURE;
        }

        $rows = DB::connection($this->connectionName())->select($this->withLimit($sql));
        $rows = array_map(fn($row) => (array)$row, $rows);

        if (blank($rows)) {
            $this->info(admin_trans('admin.console.db_empty_result'));

            return self::SUCCESS;
        }

        $this->table(array_keys($rows[0]), $rows);

        return self::SUCCESS;
    }

    /**
     * 解析数据库连接名，默认使用 admin.database.connection 保持和框架数据表一致。
     */
    protected function connectionName(): ?string
    {
        return $this->option('connection') ?: Admin::config('admin.database.connection') ?: config('database.default');
    }

    /**
     * 校验 SQL 类型，CLI 不提供写库 SQL 入口，写操作交给明确的业务命令。
     */
    protected function isReadOnlySql(string $sql): bool
    {
        return (bool)preg_match('/^\s*(select|show|describe|desc|explain|pragma)\b/i', $sql);
    }

    /**
     * 对 select 查询追加 limit；其他只读语句保持原样以避免破坏数据库语法。
     */
    protected function withLimit(string $sql): string
    {
        if (!preg_match('/^\s*select\b/i', $sql) || preg_match('/\blimit\s+\d+\s*;?\s*$/i', $sql)) {
            return $sql;
        }

        return rtrim($sql, " \t\n\r\0\x0B;") . ' limit ' . max((int)$this->option('limit'), 1);
    }

    /**
     * 处理未知 action，明确提示可用值，避免用户误以为命令无响应。
     */
    protected function failAction(string $action): int
    {
        $this->error(admin_trans('admin.console.unknown_action', ['action' => $action]));
        $this->line(admin_trans('admin.console.available_actions', ['actions' => 'info, tables, columns, query']));

        return self::FAILURE;
    }
}
