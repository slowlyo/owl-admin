<?php

namespace Slowlyo\OwlAdmin\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
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
            $this->call('admin:publish', [
                '--assets' => true,
                '--lang'   => true,
                '--config' => true,
                '--force'  => true,
            ]);

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

        if (!$this->updateAll) {
            $this->call('admin:publish', [
                '--assets' => true,
                '--lang'   => true,
                '--config' => true,
                '--force'  => true,
            ]);
        }

        if (!Schema::hasTable('admin_code_generators')) {
            Schema::create('admin_code_generators', function ($table) {
                $table->increments('id')->unsigned();
                $table->string('title')->default('')->comment('名称');
                $table->string('table_name')->default('')->comment('表名');
                $table->string('primary_key')->default('id')->comment('主键名');
                $table->string('model_name')->default('')->comment('模型名');
                $table->string('controller_name')->default('')->comment('控制器名');
                $table->string('service_name')->default('')->comment('服务名');
                $table->longText('columns')->comment('字段信息');
                $table->tinyInteger('need_timestamps')->default(0)->comment('是否需要时间戳');
                $table->tinyInteger('soft_delete')->default(0)->comment('是否需要软删除');
                $table->text('needs')->nullable()->comment('需要生成的代码');
                $table->text('menu_info')->nullable()->comment('菜单信息');
                $table->timestamps();
            });
        }
    }

    public function version259()
    {
        $this->output->title('Update to version v2.5.9');

        if (!$this->updateAll) {
            $this->call('admin:publish', [
                '--lang'   => true,
                '--assets' => true,
                '--force'  => true,
            ]);
        }

        if (!Schema::hasColumn('admin_code_generators', 'page_info')) {
            Schema::table('admin_code_generators', function ($table) {
                $table->text('page_info')->nullable()->comment('页面信息')->after('menu_info');
            });
        }
    }

    public function version276()
    {
        $this->output->title('Update to version v2.7.6');

        if (!$this->updateAll) {
            $this->call('admin:publish', [
                '--lang'   => true,
                '--assets' => true,
                '--force'  => true,
            ]);
        }

        if (!Schema::hasColumn('admin_menus', 'component')) {
            Schema::table('admin_menus', function ($table) {
                $table->string('component')->nullable()->comment('菜单组件')->after('is_home');
            });
        }

        if (!Schema::hasColumn('admin_menus', 'is_full')) {
            Schema::table('admin_menus', function ($table) {
                $table->tinyInteger('is_full')->default(0)->comment('是否是完整页面')->after('component');
            });
        }
    }

    public function version300()
    {
        $this->output->title('Update to version v3.0.0');

        if (!$this->updateAll) {
            $this->call('admin:publish', [
                '--assets' => true,
                '--lang'   => true,
                '--config' => true,
                '--force'  => true,
            ]);
        }

        settings()->set('system_theme_setting');
    }

    public function version323()
    {
        $this->output->title('Update to version v3.2.3');

        if (!Schema::hasColumn('admin_users', 'enabled')) {
            Schema::table('admin_users', function ($table) {
                $table->tinyInteger('enabled')->default(1);
            });
        }

        if (!$this->updateAll) {
            $this->call('admin:publish', [
                '--lang'   => true,
                '--force'  => true,
            ]);
        }
    }

    public function version325()
    {
        $this->output->title('Update to version v3.2.5');
        if (!Schema::hasColumn('admin_code_generators', 'save_path')) {
            Schema::table('admin_code_generators', function ($table) {
                $table->text('save_path')->nullable()->comment('保存位置');
            });
        }

        if (!$this->updateAll) {
            $this->call('admin:publish', [
                '--lang'   => true,
                '--force'  => true,
            ]);
        }
    }
}
