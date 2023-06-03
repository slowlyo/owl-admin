<?php

namespace Slowlyo\OwlAdmin\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateCommand extends Command
{
    protected $signature = 'admin:update {--v=}';

    protected $description = 'Handle admin update.';

    protected bool $updateAll = false;

    public function handle(): void
    {
        $this->checkVersion();

        if ($this->updateAll = $this->confirm('Do you want to update all?')) {
            // execute all version update order by version number
            collect(get_class_methods($this))
                ->filter(fn($method) => Str::startsWith($method, 'version'))
                ->sort()
                ->each(function ($method) {
                    $this->$method();
                });

            $this->info('Update successfully.');
        } else {
            $this->info('Update canceled.');
        }
    }

    public function checkVersion()
    {
        $version = $this->option('v');

        if (!$version) {
            return;
        }

        $func = 'version' . $version;

        if (method_exists($this, $func)) {
            $this->$func();

            $this->info('Update successfully.');
        } else {
            $this->error('Version not found.');
        }

        exit;
    }

    public function version257()
    {
        $this->output->title('Update to version v2.5.7');

        $this->call('admin:publish', [
            '--assets' => true,
            '--lang'   => true,
            '--config' => true,
            '--force'  => true,
        ]);

        if (!Schema::hasTable('admin_code_generators')) {
            $sql = <<<SQL
create table admin_code_generators
(
    id              int unsigned auto_increment
        primary key,
    title           varchar(255) default ''   not null comment '名称',
    table_name      varchar(255) default ''   not null comment '表名',
    primary_key     varchar(255) default 'id' not null comment '主键名',
    model_name      varchar(255) default ''   not null comment '模型名',
    controller_name varchar(255) default ''   not null comment '控制器名',
    service_name    varchar(255) default ''   not null comment '服务名',
    columns         longtext                  not null comment '字段信息',
    need_timestamps tinyint(1)   default 0    not null comment '是否需要时间戳',
    soft_delete     tinyint(1)   default 0    not null comment '是否需要软删除',
    needs           text                      null comment '需要生成的代码',
    menu_info       text                      null comment '菜单信息',
    created_at      timestamp                 null,
    updated_at      timestamp                 null
)
    comment '代码生成器历史记录' charset = utf8mb4;
SQL;

            DB::statement($sql);
        }
    }
}
