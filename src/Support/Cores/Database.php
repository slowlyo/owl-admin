<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;

class Database
{
    private string|null $moduleName;

    public function __construct($moduleName = null)
    {
        $this->moduleName = $moduleName;
    }

    public static function make($moduleName = null)
    {
        return new self($moduleName);
    }

    public function tableName($name)
    {
        return $this->moduleName . $name;
    }

    public function create($tableName, $callback)
    {
        Schema::create($this->tableName($tableName), $callback);
    }

    public function dropIfExists($tableName)
    {
        Schema::dropIfExists($this->tableName($tableName));
    }

    public function initSchema()
    {
        $this->down();
        $this->up();
    }

    public function up()
    {
        $this->create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 120)->unique();
            $table->string('password', 80);
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        $this->create('admin_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->timestamps();
        });

        $this->create('admin_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('slug', 50)->unique();
            $table->text('http_path')->nullable();
            $table->integer('menu_id')->default(0);
            $table->timestamps();
        });

        $this->create('admin_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 100)->comment('菜单名称');
            $table->string('icon', 100)->nullable()->comment('菜单图标');
            $table->string('url')->nullable()->comment('菜单路由');
            $table->tinyInteger('url_type')->default(1)->comment('路由类型(1:路由,2:外链)');
            $table->tinyInteger('visible')->default(1)->comment('是否可见');
            $table->tinyInteger('is_home')->default(0)->comment('是否为首页');
            $table->string('extension')->nullable()->comment('扩展');

            $table->timestamps();
        });

        $this->create('admin_role_users', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('user_id');
            $table->index(['role_id', 'user_id']);
            $table->timestamps();
        });

        $this->create('admin_role_permissions', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->index(['role_id', 'permission_id']);
            $table->timestamps();
        });

        $this->create('admin_role_menus', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('menu_id');
            $table->index(['role_id', 'menu_id']);
            $table->timestamps();
        });

        // 如果是模块，跳过下面的表
        if ($this->moduleName) {
            return;
        }

        $this->create('admin_code_generators', function (Blueprint $table) {
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
            $table->text('page_info')->nullable()->comment('页面信息');
            $table->timestamps();
        });

        $this->create('admin_settings', function (Blueprint $table) {
            $table->string('key');
            $table->longText('values');
            $table->timestamps();
        });

        $this->create('admin_extensions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->unique();
            $table->tinyInteger('is_enabled')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->dropIfExists('admin_users');
        $this->dropIfExists('admin_roles');
        $this->dropIfExists('admin_permissions');
        $this->dropIfExists('admin_menus');
        $this->dropIfExists('admin_role_users');
        $this->dropIfExists('admin_role_permissions');
        $this->dropIfExists('admin_role_menus');

        // 如果是模块，跳过下面的表
        if ($this->moduleName) {
            return;
        }

        $this->dropIfExists('admin_code_generators');
        $this->dropIfExists('admin_settings');
        $this->dropIfExists('admin_extensions');
    }

    /**
     * 填充初始数据
     *
     * @return void
     */
    public function fillInitialData()
    {
        $data = function ($data) {
            foreach ($data as $k => $v) {
                if (is_array($v)) {
                    // $data[$k] = "['" . implode("','", $v) . "']";
                    $data[$k] = json_encode($v, JSON_UNESCAPED_UNICODE);
                }
            }
            return array_merge($data, ['created_at' => now(), 'updated_at' => now()]);
        };

        $adminUser       = DB::table($this->tableName('admin_users'));
        $adminMenu       = DB::table($this->tableName('admin_menus'));
        $adminPermission = DB::table($this->tableName('admin_permissions'));
        $adminRole       = DB::table($this->tableName('admin_roles'));

        // 创建初始用户
        $adminUser->truncate();
        $adminUser->insert($data([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name'     => 'Administrator',
        ]));

        // 创建初始角色
        $adminRole->truncate();
        $adminRole->insert($data([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]));

        // 用户 - 角色绑定
        DB::table($this->tableName('admin_role_users'))->truncate();
        DB::table($this->tableName('admin_role_users'))->insert($data([
            'role_id' => 1,
            'user_id' => 1,
        ]));

        // 创建初始菜单   ['add', 'del', 'edit', 'show', 'batchDel']
        $adminMenu->truncate();
        $adminMenu->insert([
            $data([
                'parent_id' => 0,
                'title'     => 'dashboard',
                'icon'      => 'mdi:chart-line',
                'url'       => '/dashboard',
                'is_home'   => 1,
            ]),
            $data([
                'parent_id' => 0,
                'title'     => 'admin_system',
                'icon'      => 'material-symbols:settings-outline',
                'url'       => '/system',
                'is_home'   => 0,
            ]),
            $data([
                'parent_id' => 2,
                'title'     => 'admin_users',
                'icon'      => 'ph:user-gear',
                'url'       => '/system/admin_users',
                'is_home'   => 0,
            ]),
            $data([
                'parent_id' => 2,
                'title'     => 'admin_roles',
                'icon'      => 'carbon:user-role',
                'url'       => '/system/admin_roles',
                'is_home'   => 0,
            ]),
            $data([
                'parent_id' => 2,
                'title'     => 'admin_permission',
                'icon'      => 'fluent-mdl2:permissions',
                'url'       => '/system/admin_permissions',
                'is_home'   => 0,
            ]),
            $data([
                'parent_id' => 2,
                'title'     => 'admin_menu',
                'icon'      => 'ant-design:menu-unfold-outlined',
                'url'       => '/system/admin_menus',
                'is_home'   => 0,
            ]),
            $data([
                'parent_id' => 2,
                'title'     => 'admin_setting',
                'icon'      => 'akar-icons:settings-horizontal',
                'url'       => '/system/settings',
                'is_home'   => 0,
            ]),
        ]);

        // 角色 - 菜单绑定
        DB::table($this->tableName('admin_role_menus'))->truncate();
        $menu_ids = $adminMenu->pluck('id');
        foreach ($menu_ids as $id) {
            DB::table($this->tableName('admin_role_menus'))->insert($data([
                'role_id'       => 1,
                'menu_id'       => $id,
            ]));
        }

        // 创建初始权限
        $adminPermission->truncate();
        $permissions = [
            $data(['name' => '列表', 'slug' => Str::uuid(), 'http_path' => ['get:/system/admin_users'], 'menu_id' => 3]),
            $data(['name' => '新增', 'slug' => Str::uuid(), 'http_path' => ['post:/system/admin_users'], 'menu_id' => 3]),
            $data(['name' => '编辑', 'slug' => Str::uuid(), 'http_path' => ['get:/system/admin_users/*/edit', 'put:/system/admin_users/*'], 'menu_id' => 3]),
            $data(['name' => '批量删除', 'slug' => Str::uuid(), 'http_path' => ['delete:/system/admin_users/*'], 'menu_id' => 3]),

            $data(['name' => '列表', 'slug' => Str::uuid(), 'http_path' => ['get:/system/admin_roles'], 'menu_id' => 4]),
            $data(['name' => '新增', 'slug' => Str::uuid(), 'http_path' => ['post:/system/admin_roles'], 'menu_id' => 4]),
            $data(['name' => '编辑', 'slug' => Str::uuid(), 'http_path' => ['get:/system/admin_roles/*/edit', 'put:/system/admin_roles/*'], 'menu_id' => 4]),
            $data(['name' => '批量删除', 'slug' => Str::uuid(), 'http_path' => ['delete:/system/admin_roles/*'], 'menu_id' => 4]),

            $data(['name' => '列表', 'slug' => Str::uuid(), 'http_path' => ['get:/system/admin_permissions'], 'menu_id' => 5]),
            $data(['name' => '新增', 'slug' => Str::uuid(), 'http_path' => ['post:/system/admin_permissions'], 'menu_id' => 5]),
            $data(['name' => '删除', 'slug' => Str::uuid(), 'http_path' => ['delete:/system/admin_permissions/*'], 'menu_id' => 5]),
            $data(['name' => '编辑', 'slug' => Str::uuid(), 'http_path' => ['get:/system/admin_permissions/*/edit', 'put:/system/admin_permissions/*'], 'menu_id' => 5]),
            $data(['name' => '批量删除', 'slug' => Str::uuid(), 'http_path' => ['delete:/system/admin_permissions/*'], 'menu_id' => 5]),

            $data(['name' => '列表', 'slug' => Str::uuid(), 'http_path' => ['get:/system/admin_menus'], 'menu_id' => 6]),
            $data(['name' => '新增', 'slug' => Str::uuid(), 'http_path' => ['post:/system/admin_menus'], 'menu_id' => 6]),
            $data(['name' => '删除', 'slug' => Str::uuid(), 'http_path' => ['delete:/system/admin_menus/*'], 'menu_id' => 6]),
            $data(['name' => '编辑', 'slug' => Str::uuid(), 'http_path' => ['get:/system/admin_menus/*/edit', 'put:/system/admin_menus/*'], 'menu_id' => 6]),
            $data(['name' => '批量删除', 'slug' => Str::uuid(), 'http_path' => ['delete:/system/admin_menus/*'], 'menu_id' => 6]),
        ];

        $adminPermission->insert($permissions);

        // 角色 - 权限绑定
        DB::table($this->tableName('admin_role_permissions'))->truncate();
        $permission_ids = $adminPermission->pluck('id');
        foreach ($permission_ids as $id) {
            DB::table($this->tableName('admin_role_permissions'))->insert($data([
                'role_id'       => 1,
                'permission_id' => $id,
            ]));
        }
    }
}
