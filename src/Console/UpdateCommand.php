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

    public function schema()
    {
        return Schema::connection(config('admin.database.connection'));
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

        if (!$this->schema()->hasTable('admin_code_generators')) {
            $this->schema()->create('admin_code_generators', function ($table) {
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

        if (!$this->schema()->hasColumn('admin_code_generators', 'page_info')) {
            $this->schema()->table('admin_code_generators', function ($table) {
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

        if (!$this->schema()->hasColumn('admin_menus', 'component')) {
            $this->schema()->table('admin_menus', function ($table) {
                $table->string('component')->nullable()->comment('菜单组件')->after('is_home');
            });
        }

        if (!$this->schema()->hasColumn('admin_menus', 'is_full')) {
            $this->schema()->table('admin_menus', function ($table) {
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

        if (!$this->schema()->hasColumn('admin_users', 'enabled')) {
            $this->schema()->table('admin_users', function ($table) {
                $table->tinyInteger('enabled')->default(1);
            });
        }

        if (!$this->updateAll) {
            $this->call('admin:publish', [
                '--lang'  => true,
                '--force' => true,
            ]);
        }
    }

    public function version341()
    {
        $this->output->title('Update to version v3.4.1');
        if (!$this->schema()->hasColumn('admin_menus', 'keep_alive')) {
            $this->schema()->table('admin_menus', function ($table) {
                $table->tinyInteger('keep_alive')->nullable()->comment('页面缓存');
                $table->string('iframe_url')->nullable()->comment('iframe_url');
            });
        }
        if (!$this->updateAll) {
            $this->call('admin:publish', [
                '--assets' => true,
                '--lang'   => true,
                '--force'  => true,
            ]);
        }
    }

    public function version350()
    {
        $this->output->title('Update to version v3.5.0');

        if (!$this->updateAll) {
            $this->call('admin:publish', [
                '--assets' => true,
                '--lang'   => true,
                '--config' => true,
                '--force'  => true,
            ]);
        }

        if (!$this->schema()->hasTable('admin_pages')) {
            $this->schema()->create('admin_pages', function ($table) {
                $table->id();
                $table->string('title')->comment('页面名称');
                $table->string('sign')->comment('页面标识');
                $table->longText('schema')->comment('页面结构');
                $table->timestamps();
            });
        }

        if (!$this->schema()->hasTable('admin_relationships')) {
            $this->schema()->create('admin_relationships', function ($table) {
                $table->id();
                $table->string('model')->comment('模型');
                $table->string('title')->comment('关联名称');
                $table->string('type')->comment('关联类型');
                $table->string('remark')->comment('关联名称')->nullable();
                $table->text('args')->comment('关联参数')->nullable();
                $table->text('extra')->comment('额外参数')->nullable();
                $table->timestamps();
            });
        }

        if (!$this->schema()->hasTable('admin_apis')) {
            $this->schema()->create('admin_apis', function ($table) {
                $table->id();
                $table->string('title')->comment('接口名称');
                $table->string('path')->comment('接口路径');
                $table->string('template')->comment('接口模板');
                $table->tinyInteger('enabled')->default(1)->comment('是否启用');
                $table->longText('args')->comment('接口参数')->nullable();
                $table->timestamps();
            });
        }
    }

    public function version373()
    {
        $this->output->title('Update to version v3.7.3');

        if (!$this->schema()->hasColumn('admin_menus', 'custom_order')) {
            $this->schema()->table('admin_menus', function ($table) {
                $table->integer('custom_order')->default(0);
            });
        }

        if (!$this->schema()->hasColumn('admin_permissions', 'custom_order')) {
            $this->schema()->table('admin_permissions', function ($table) {
                $table->integer('custom_order')->default(0);
            });
        }
    }
}
