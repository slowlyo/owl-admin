<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Slowlyo\OwlAdmin\Models\AdminRole;
use Illuminate\Database\Schema\Blueprint;
use Slowlyo\OwlAdmin\Admin;

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
            $table->id();
            $table->string('username', 120)->unique();
            $table->string('password', 80);
            $table->tinyInteger('enabled')->default(1);
            $table->string('name')->default('');
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        $this->create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->timestamps();
        });

        $this->create('admin_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->text('http_method')->nullable();
            $table->text('http_path')->nullable();
            $table->integer('custom_order')->default(0);
            $table->integer('parent_id')->default(0);
            $table->timestamps();
        });

        $this->create('admin_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->integer('custom_order')->default(0);
            $table->string('title', 100)->comment('菜单名称');
            $table->string('icon', 100)->nullable()->comment('菜单图标');
            $table->string('url')->nullable()->comment('菜单路由');
            $table->tinyInteger('url_type')->default(1)->comment('路由类型(1:路由,2:外链,3:iframe)');
            $table->tinyInteger('visible')->default(1)->comment('是否可见');
            $table->tinyInteger('is_home')->default(0)->comment('是否为首页');
            $table->tinyInteger('keep_alive')->nullable()->comment('页面缓存');
            $table->string('iframe_url')->nullable()->comment('iframe_url');
            $table->string('component')->nullable()->comment('菜单组件');
            $table->tinyInteger('is_full')->default(0)->comment('是否是完整页面');
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

        $this->create('admin_permission_menu', function (Blueprint $table) {
            $table->integer('permission_id');
            $table->integer('menu_id');
            $table->index(['permission_id', 'menu_id']);
            $table->timestamps();
        });

        // 如果是模块，跳过下面的表
        if ($this->moduleName) {
            return;
        }

        $this->create('admin_code_generators', function (Blueprint $table) {
            $table->id();
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
            $table->string('key')->default('');
            $table->longText('values')->nullable();
            $table->timestamps();
        });

        $this->create('admin_extensions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->tinyInteger('is_enabled')->default(0);
            $table->timestamps();
        });

        $this->create('admin_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('页面名称');
            $table->string('sign')->comment('页面标识');
            $table->longText('schema')->comment('页面结构');
            $table->timestamps();
        });

        $this->create('admin_relationships', function (Blueprint $table) {
            $table->id();
            $table->string('model')->comment('模型');
            $table->string('title')->comment('关联名称');
            $table->string('type')->comment('关联类型');
            $table->string('remark')->comment('关联名称')->nullable();
            $table->text('args')->comment('关联参数')->nullable();
            $table->text('extra')->comment('额外参数')->nullable();
            $table->timestamps();
        });

        $this->create('admin_apis', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('接口名称');
            $table->string('path')->comment('接口路径');
            $table->string('template')->comment('接口模板');
            $table->tinyInteger('enabled')->default(1)->comment('是否启用');
            $table->longText('args')->comment('接口参数')->nullable();
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
        $this->dropIfExists('admin_permission_menu');

        // 如果是模块，跳过下面的表
        if ($this->moduleName) {
            return;
        }

        $this->dropIfExists('admin_code_generators');
        $this->dropIfExists('admin_settings');
        $this->dropIfExists('admin_extensions');
        $this->dropIfExists('admin_pages');
        $this->dropIfExists('admin_relationships');
        $this->dropIfExists('admin_apis');
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
                    $data[$k] = "['" . implode("','", $v) . "']";
                }
            }
            $now = date('Y-m-d H:i:s');

            return array_merge($data, ['created_at' => $now, 'updated_at' => $now]);
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
            'slug' => AdminRole::SuperAdministrator,
        ]));

        // 用户 - 角色绑定
        DB::table($this->tableName('admin_role_users'))->truncate();
        DB::table($this->tableName('admin_role_users'))->insert($data([
            'role_id' => 1,
            'user_id' => 1,
        ]));

        // 创建初始权限
        $adminPermission->truncate();
        $adminPermission->insert([
            $data(['name' => '首页', 'slug' => 'home', 'http_path' => ['/home*'], "parent_id" => 0]),
            $data(['name' => '系统', 'slug' => 'system', 'http_path' => '', "parent_id" => 0]),
            $data(['name' => '管理员', 'slug' => 'admin_users', 'http_path' => ["/admin_users*"], "parent_id" => 2]),
            $data(['name' => '角色', 'slug' => 'roles', 'http_path' => ["/roles*"], "parent_id" => 2]),
            $data(['name' => '权限', 'slug' => 'permissions', 'http_path' => ["/permissions*"], "parent_id" => 2]),
            $data(['name' => '菜单', 'slug' => 'menus', 'http_path' => ["/menus*"], "parent_id" => 2]),
            $data(['name' => '设置', 'slug' => 'settings', 'http_path' => ["/settings*"], "parent_id" => 2]),
        ]);

        // 角色 - 权限绑定
        DB::table($this->tableName('admin_role_permissions'))->truncate();
        $permissionIds = DB::table($this->tableName('admin_permissions'))->orderBy('id')->pluck('id');
        foreach ($permissionIds as $id) {
            DB::table($this->tableName('admin_role_permissions'))->insert($data([
                'role_id'       => 1,
                'permission_id' => $id,
            ]));
        }

        // 创建初始菜单
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

        // 权限 - 菜单绑定
        DB::table($this->tableName('admin_permission_menu'))->truncate();
        $menus = $adminMenu->get();
        foreach ($menus as $menu) {
            $_list   = [];
            $_list[] = $data(['permission_id' => $menu->id, 'menu_id' => $menu->id]);

            if ($menu->parent_id != 0) {
                $_list[] = $data(['permission_id' => $menu->parent_id, 'menu_id' => $menu->id]);
            }

            DB::table($this->tableName('admin_permission_menu'))->insert($_list);
        }

        // 默认中文
        settings()->set('admin_locale', 'zh_CN');

        // 填充代码生成器常用字段
        $this->fillCodeGeneratorFields();
    }

    public static function isConnected()
    {
        try {
            $connection = Admin::config('admin.database.connection');
            DB::connection($connection)->getPdo();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getTables()
    {
        return Admin::context()->remember('admin_all_tables', function () {
            $connection = Admin::config('admin.database.connection');
            $db = DB::connection($connection);
            $list = match ($connection) {
                // sqlite
                'sqlite' => $db->getPdo()->query("SELECT name FROM sqlite_master WHERE type='table';")->fetchAll(),
                // pgsql
                'pgsql' => $db->getPdo()->query("SELECT tablename FROM pg_tables WHERE schemaname='public';")->fetchAll(),
                // mysql
                default => $db->getPdo()->query('SHOW TABLES')->fetchAll(),
            };

            return array_map(fn($i) => self::getTableName(array_shift($i), true), $list);
        });
    }

    public static function getTableName($table = '', $removePrefix = false, $connection = '')
    {
        if (blank($connection)) {
            $connection = Admin::config('admin.database.connection');
        }
        $prefix = config("database.connections.{$connection}.prefix");

        if ($removePrefix) {
            return \Illuminate\Support\Str::replaceFirst($prefix, '', $table);
        }

        return $prefix . $table;
    }

    public static function getTableColumns($table, $connection = '')
    {
        if (blank($connection)) {
            $connection = Admin::config('admin.database.connection');
        }

        $table = self::getTableName($table, false, $connection);

        $db = DB::connection($connection);
        $driver = config('database.connections.'. $connection . '.driver');
        $columns = match ($driver) {
            // sqlite
            'sqlite' => $db->getPdo()->query("PRAGMA table_info('{$table}')")->fetchAll(),
            // pgsql
            'pgsql' => $db->getPdo()->query("SELECT column_name, data_type, character_maximum_length, column_default, is_nullable FROM information_schema.columns WHERE table_name = '{$table}'")->fetchAll(),
            // mysql
            default => $db->getPdo()->query("SHOW COLUMNS FROM `{$table}`")->fetchAll(),
        };

        // 提取字段名
        $columnNames = match ($driver) {
            'sqlite' => array_map(fn($column) => $column['name'], $columns),
            'pgsql' => array_map(fn($column) => $column['column_name'], $columns),
            default => array_map(fn($column) => $column['Field'], $columns),
        };

        return $columnNames;
    }

    /**
     * 填充代码生成器常用字段
     *
     * @return void
     */
    public function fillCodeGeneratorFields()
    {
        if ($this->moduleName) return;

        $data = [
            'admin_common_field'        => '{"标题/名称":{"name":"title","type":"string","default":null,"nullable":false,"comment":"标题","action_scope":["list","detail","create","edit"],"file_column":0,"list_component":{"list_component_property":[{"name":"searchable","value":"1"}],"list_component_type":"TableColumn","component_property_options":[{"label":"align","value":"align"},{"label":"breakpoint","value":"breakpoint"},{"label":"canAccessSuperData","value":"canAccessSuperData"},{"label":"className","value":"className"},{"label":"classNameExpr","value":"classNameExpr"},{"label":"copyable","value":"copyable"},{"label":"filterable","value":"filterable"},{"label":"fixed","value":"fixed"},{"label":"headerAlign","value":"headerAlign"},{"label":"innerStyle","value":"innerStyle"},{"label":"labelClassName","value":"labelClassName"},{"label":"lazyRenderAfter","value":"lazyRenderAfter"},{"label":"popOver","value":"popOver"},{"label":"quickEdit","value":"quickEdit"},{"label":"quickEditOnUpdate","value":"quickEditOnUpdate"},{"label":"remark","value":"remark"},{"label":"searchable","value":"searchable"},{"label":"sortable","value":"sortable"},{"label":"toggled","value":"toggled"},{"label":"type","value":"type"},{"label":"unique","value":"unique"},{"label":"vAlign","value":"vAlign"},{"label":"value","value":"value"},{"label":"width","value":"width"},{"label":"make","value":"make"},{"label":"permission","value":"permission"},{"label":"filteredResults","value":"filteredResults"},{"label":"macro","value":"macro"},{"label":"mixin","value":"mixin"},{"label":"hasMacro","value":"hasMacro"},{"label":"flushMacros","value":"flushMacros"},{"label":"__callStatic","value":"__callStatic"},{"label":"macroCall","value":"macroCall"}]},"form_component":{"form_component_type":"TextControl","component_property_options":[{"label":"addApi","value":"addApi"},{"label":"addControls","value":"addControls"},{"label":"addDialog","value":"addDialog"},{"label":"addOn","value":"addOn"},{"label":"autoComplete","value":"autoComplete"},{"label":"autoFill","value":"autoFill"},{"label":"borderMode","value":"borderMode"},{"label":"className","value":"className"},{"label":"clearValueOnEmpty","value":"clearValueOnEmpty"},{"label":"clearValueOnHidden","value":"clearValueOnHidden"},{"label":"clearable","value":"clearable"},{"label":"creatable","value":"creatable"},{"label":"createBtnLabel","value":"createBtnLabel"},{"label":"deferApi","value":"deferApi"},{"label":"deferField","value":"deferField"},{"label":"deleteApi","value":"deleteApi"},{"label":"deleteConfirmText","value":"deleteConfirmText"},{"label":"delimiter","value":"delimiter"},{"label":"desc","value":"desc"},{"label":"description","value":"description"},{"label":"descriptionClassName","value":"descriptionClassName"},{"label":"disabled","value":"disabled"},{"label":"disabledOn","value":"disabledOn"},{"label":"editApi","value":"editApi"},{"label":"editControls","value":"editControls"},{"label":"editDialog","value":"editDialog"},{"label":"editable","value":"editable"},{"label":"editorSetting","value":"editorSetting"},{"label":"extraName","value":"extraName"},{"label":"extractValue","value":"extractValue"},{"label":"hidden","value":"hidden"},{"label":"hiddenOn","value":"hiddenOn"},{"label":"hint","value":"hint"},{"label":"horizontal","value":"horizontal"},{"label":"id","value":"id"},{"label":"initAutoFill","value":"initAutoFill"},{"label":"initFetch","value":"initFetch"},{"label":"initFetchOn","value":"initFetchOn"},{"label":"inline","value":"inline"},{"label":"inputClassName","value":"inputClassName"},{"label":"inputControlClassName","value":"inputControlClassName"},{"label":"joinValues","value":"joinValues"},{"label":"labelAlign","value":"labelAlign"},{"label":"labelClassName","value":"labelClassName"},{"label":"labelRemark","value":"labelRemark"},{"label":"labelWidth","value":"labelWidth"},{"label":"maxLength","value":"maxLength"},{"label":"minLength","value":"minLength"},{"label":"mode","value":"mode"},{"label":"multiple","value":"multiple"},{"label":"nativeAutoComplete","value":"nativeAutoComplete"},{"label":"nativeInputClassName","value":"nativeInputClassName"},{"label":"onEvent","value":"onEvent"},{"label":"options","value":"options"},{"label":"placeholder","value":"placeholder"},{"label":"prefix","value":"prefix"},{"label":"readOnly","value":"readOnly"},{"label":"readOnlyOn","value":"readOnlyOn"},{"label":"remark","value":"remark"},{"label":"removable","value":"removable"},{"label":"required","value":"required"},{"label":"resetValue","value":"resetValue"},{"label":"row","value":"row"},{"label":"saveImmediately","value":"saveImmediately"},{"label":"selectFirst","value":"selectFirst"},{"label":"showCounter","value":"showCounter"},{"label":"size","value":"size"},{"label":"source","value":"source"},{"label":"static","value":"static"},{"label":"staticClassName","value":"staticClassName"},{"label":"staticInputClassName","value":"staticInputClassName"},{"label":"staticLabelClassName","value":"staticLabelClassName"},{"label":"staticOn","value":"staticOn"},{"label":"staticPlaceholder","value":"staticPlaceholder"},{"label":"staticSchema","value":"staticSchema"},{"label":"style","value":"style"},{"label":"submitOnChange","value":"submitOnChange"},{"label":"suffix","value":"suffix"},{"label":"testIdBuilder","value":"testIdBuilder"},{"label":"transform","value":"transform"},{"label":"trimContents","value":"trimContents"},{"label":"type","value":"type"},{"label":"useMobileUI","value":"useMobileUI"},{"label":"validateApi","value":"validateApi"},{"label":"validateOnChange","value":"validateOnChange"},{"label":"validationErrors","value":"validationErrors"},{"label":"validations","value":"validations"},{"label":"value","value":"value"},{"label":"valuesNoWrap","value":"valuesNoWrap"},{"label":"visible","value":"visible"},{"label":"visibleOn","value":"visibleOn"},{"label":"width","value":"width"},{"label":"make","value":"make"},{"label":"permission","value":"permission"},{"label":"filteredResults","value":"filteredResults"},{"label":"macro","value":"macro"},{"label":"mixin","value":"mixin"},{"label":"hasMacro","value":"hasMacro"},{"label":"flushMacros","value":"flushMacros"},{"label":"__callStatic","value":"__callStatic"},{"label":"macroCall","value":"macroCall"}],"form_component_property":[{"name":"required","value":"1"}]},"detail_component":[],"list_filter":[{"mode":"input","type":"contains","filter":{"filter_type":"TextControl","filter_property":[{"name":"size","value":"md"},{"name":"clearable","value":1}],"component_property_options":[{"label":"addApi","value":"addApi"},{"label":"addControls","value":"addControls"},{"label":"addDialog","value":"addDialog"},{"label":"addOn","value":"addOn"},{"label":"autoComplete","value":"autoComplete"},{"label":"autoFill","value":"autoFill"},{"label":"borderMode","value":"borderMode"},{"label":"className","value":"className"},{"label":"clearValueOnEmpty","value":"clearValueOnEmpty"},{"label":"clearValueOnHidden","value":"clearValueOnHidden"},{"label":"clearable","value":"clearable"},{"label":"creatable","value":"creatable"},{"label":"createBtnLabel","value":"createBtnLabel"},{"label":"deferApi","value":"deferApi"},{"label":"deferField","value":"deferField"},{"label":"deleteApi","value":"deleteApi"},{"label":"deleteConfirmText","value":"deleteConfirmText"},{"label":"delimiter","value":"delimiter"},{"label":"desc","value":"desc"},{"label":"description","value":"description"},{"label":"descriptionClassName","value":"descriptionClassName"},{"label":"disabled","value":"disabled"},{"label":"disabledOn","value":"disabledOn"},{"label":"editApi","value":"editApi"},{"label":"editControls","value":"editControls"},{"label":"editDialog","value":"editDialog"},{"label":"editable","value":"editable"},{"label":"editorSetting","value":"editorSetting"},{"label":"extraName","value":"extraName"},{"label":"extractValue","value":"extractValue"},{"label":"hidden","value":"hidden"},{"label":"hiddenOn","value":"hiddenOn"},{"label":"hint","value":"hint"},{"label":"horizontal","value":"horizontal"},{"label":"id","value":"id"},{"label":"initAutoFill","value":"initAutoFill"},{"label":"initFetch","value":"initFetch"},{"label":"initFetchOn","value":"initFetchOn"},{"label":"inline","value":"inline"},{"label":"inputClassName","value":"inputClassName"},{"label":"inputControlClassName","value":"inputControlClassName"},{"label":"joinValues","value":"joinValues"},{"label":"labelAlign","value":"labelAlign"},{"label":"labelClassName","value":"labelClassName"},{"label":"labelRemark","value":"labelRemark"},{"label":"labelWidth","value":"labelWidth"},{"label":"maxLength","value":"maxLength"},{"label":"minLength","value":"minLength"},{"label":"mode","value":"mode"},{"label":"multiple","value":"multiple"},{"label":"nativeAutoComplete","value":"nativeAutoComplete"},{"label":"nativeInputClassName","value":"nativeInputClassName"},{"label":"onEvent","value":"onEvent"},{"label":"options","value":"options"},{"label":"placeholder","value":"placeholder"},{"label":"prefix","value":"prefix"},{"label":"readOnly","value":"readOnly"},{"label":"readOnlyOn","value":"readOnlyOn"},{"label":"remark","value":"remark"},{"label":"removable","value":"removable"},{"label":"required","value":"required"},{"label":"resetValue","value":"resetValue"},{"label":"row","value":"row"},{"label":"saveImmediately","value":"saveImmediately"},{"label":"selectFirst","value":"selectFirst"},{"label":"showCounter","value":"showCounter"},{"label":"size","value":"size"},{"label":"source","value":"source"},{"label":"static","value":"static"},{"label":"staticClassName","value":"staticClassName"},{"label":"staticInputClassName","value":"staticInputClassName"},{"label":"staticLabelClassName","value":"staticLabelClassName"},{"label":"staticOn","value":"staticOn"},{"label":"staticPlaceholder","value":"staticPlaceholder"},{"label":"staticSchema","value":"staticSchema"},{"label":"style","value":"style"},{"label":"submitOnChange","value":"submitOnChange"},{"label":"suffix","value":"suffix"},{"label":"testIdBuilder","value":"testIdBuilder"},{"label":"transform","value":"transform"},{"label":"trimContents","value":"trimContents"},{"label":"type","value":"type"},{"label":"useMobileUI","value":"useMobileUI"},{"label":"validateApi","value":"validateApi"},{"label":"validateOnChange","value":"validateOnChange"},{"label":"validationErrors","value":"validationErrors"},{"label":"validations","value":"validations"},{"label":"value","value":"value"},{"label":"valuesNoWrap","value":"valuesNoWrap"},{"label":"visible","value":"visible"},{"label":"visibleOn","value":"visibleOn"},{"label":"width","value":"width"},{"label":"make","value":"make"},{"label":"permission","value":"permission"},{"label":"filteredResults","value":"filteredResults"},{"label":"macro","value":"macro"},{"label":"mixin","value":"mixin"},{"label":"hasMacro","value":"hasMacro"},{"label":"flushMacros","value":"flushMacros"},{"label":"__callStatic","value":"__callStatic"},{"label":"macroCall","value":"macroCall"}]},"input_name":"keywords"}]},"单图":{"name":"image","type":"string","default":null,"nullable":true,"comment":"单图","action_scope":["list","detail","create","edit"],"file_column":true,"list_component":{"list_component_type":"TableColumn","component_property_options":[{"label":"align","value":"align"},{"label":"breakpoint","value":"breakpoint"},{"label":"canAccessSuperData","value":"canAccessSuperData"},{"label":"className","value":"className"},{"label":"classNameExpr","value":"classNameExpr"},{"label":"copyable","value":"copyable"},{"label":"filterable","value":"filterable"},{"label":"fixed","value":"fixed"},{"label":"headerAlign","value":"headerAlign"},{"label":"innerStyle","value":"innerStyle"},{"label":"labelClassName","value":"labelClassName"},{"label":"lazyRenderAfter","value":"lazyRenderAfter"},{"label":"popOver","value":"popOver"},{"label":"quickEdit","value":"quickEdit"},{"label":"quickEditOnUpdate","value":"quickEditOnUpdate"},{"label":"remark","value":"remark"},{"label":"searchable","value":"searchable"},{"label":"sortable","value":"sortable"},{"label":"toggled","value":"toggled"},{"label":"type","value":"type"},{"label":"unique","value":"unique"},{"label":"vAlign","value":"vAlign"},{"label":"value","value":"value"},{"label":"width","value":"width"},{"label":"make","value":"make"},{"label":"permission","value":"permission"},{"label":"filteredResults","value":"filteredResults"},{"label":"macro","value":"macro"},{"label":"mixin","value":"mixin"},{"label":"hasMacro","value":"hasMacro"},{"label":"flushMacros","value":"flushMacros"},{"label":"__callStatic","value":"__callStatic"},{"label":"macroCall","value":"macroCall"}],"list_component_property":[{"name":"type","value":"image"},{"name":"enlargeAble","value":"1"}]},"form_component":{"form_component_type":"ImageControl","component_property_options":[{"label":"accept","value":"accept"},{"label":"allowInput","value":"allowInput"},{"label":"autoFill","value":"autoFill"},{"label":"autoUpload","value":"autoUpload"},{"label":"btnClassName","value":"btnClassName"},{"label":"btnUploadClassName","value":"btnUploadClassName"},{"label":"capture","value":"capture"},{"label":"className","value":"className"},{"label":"clearValueOnHidden","value":"clearValueOnHidden"},{"label":"compress","value":"compress"},{"label":"compressOptions","value":"compressOptions"},{"label":"crop","value":"crop"},{"label":"cropFormat","value":"cropFormat"},{"label":"cropQuality","value":"cropQuality"},{"label":"delimiter","value":"delimiter"},{"label":"desc","value":"desc"},{"label":"description","value":"description"},{"label":"descriptionClassName","value":"descriptionClassName"},{"label":"disabled","value":"disabled"},{"label":"disabledOn","value":"disabledOn"},{"label":"draggable","value":"draggable"},{"label":"draggableTip","value":"draggableTip"},{"label":"dropCrop","value":"dropCrop"},{"label":"editorSetting","value":"editorSetting"},{"label":"extraName","value":"extraName"},{"label":"extractValue","value":"extractValue"},{"label":"fixedSize","value":"fixedSize"},{"label":"fixedSizeClassName","value":"fixedSizeClassName"},{"label":"frameImage","value":"frameImage"},{"label":"hidden","value":"hidden"},{"label":"hiddenOn","value":"hiddenOn"},{"label":"hideUploadButton","value":"hideUploadButton"},{"label":"hint","value":"hint"},{"label":"horizontal","value":"horizontal"},{"label":"id","value":"id"},{"label":"imageClassName","value":"imageClassName"},{"label":"initAutoFill","value":"initAutoFill"},{"label":"initCrop","value":"initCrop"},{"label":"inline","value":"inline"},{"label":"inputClassName","value":"inputClassName"},{"label":"joinValues","value":"joinValues"},{"label":"labelAlign","value":"labelAlign"},{"label":"labelClassName","value":"labelClassName"},{"label":"labelRemark","value":"labelRemark"},{"label":"labelWidth","value":"labelWidth"},{"label":"limit","value":"limit"},{"label":"maxLength","value":"maxLength"},{"label":"maxSize","value":"maxSize"},{"label":"mode","value":"mode"},{"label":"multiple","value":"multiple"},{"label":"onEvent","value":"onEvent"},{"label":"placeholder","value":"placeholder"},{"label":"reCropable","value":"reCropable"},{"label":"readOnly","value":"readOnly"},{"label":"readOnlyOn","value":"readOnlyOn"},{"label":"receiver","value":"receiver"},{"label":"remark","value":"remark"},{"label":"required","value":"required"},{"label":"resetValue","value":"resetValue"},{"label":"row","value":"row"},{"label":"saveImmediately","value":"saveImmediately"},{"label":"showCompressOptions","value":"showCompressOptions"},{"label":"size","value":"size"},{"label":"src","value":"src"},{"label":"static","value":"static"},{"label":"staticClassName","value":"staticClassName"},{"label":"staticInputClassName","value":"staticInputClassName"},{"label":"staticLabelClassName","value":"staticLabelClassName"},{"label":"staticOn","value":"staticOn"},{"label":"staticPlaceholder","value":"staticPlaceholder"},{"label":"staticSchema","value":"staticSchema"},{"label":"style","value":"style"},{"label":"submitOnChange","value":"submitOnChange"},{"label":"testIdBuilder","value":"testIdBuilder"},{"label":"thumbMode","value":"thumbMode"},{"label":"thumbRatio","value":"thumbRatio"},{"label":"type","value":"type"},{"label":"uploadBtnText","value":"uploadBtnText"},{"label":"useMobileUI","value":"useMobileUI"},{"label":"validateApi","value":"validateApi"},{"label":"validateOnChange","value":"validateOnChange"},{"label":"validationErrors","value":"validationErrors"},{"label":"validations","value":"validations"},{"label":"value","value":"value"},{"label":"visible","value":"visible"},{"label":"visibleOn","value":"visibleOn"},{"label":"width","value":"width"},{"label":"make","value":"make"},{"label":"permission","value":"permission"},{"label":"filteredResults","value":"filteredResults"},{"label":"macro","value":"macro"},{"label":"mixin","value":"mixin"},{"label":"hasMacro","value":"hasMacro"},{"label":"flushMacros","value":"flushMacros"},{"label":"__callStatic","value":"__callStatic"},{"label":"macroCall","value":"macroCall"},{"label":"uploadImagePath","value":"uploadImagePath"},{"label":"uploadImage","value":"uploadImage"},{"label":"uploadFilePath","value":"uploadFilePath"},{"label":"uploadFile","value":"uploadFile"},{"label":"uploadRichPath","value":"uploadRichPath"},{"label":"uploadRich","value":"uploadRich"},{"label":"chunkUploadStart","value":"chunkUploadStart"},{"label":"chunkUpload","value":"chunkUpload"},{"label":"chunkUploadFinish","value":"chunkUploadFinish"}],"form_component_property":[{"name":"required","value":"1"}]},"detail_component":{"detail_component_type":"StaticExactControl","component_property_options":[{"label":"autoFill","value":"autoFill"},{"label":"borderMode","value":"borderMode"},{"label":"className","value":"className"},{"label":"clearValueOnHidden","value":"clearValueOnHidden"},{"label":"copyable","value":"copyable"},{"label":"desc","value":"desc"},{"label":"description","value":"description"},{"label":"descriptionClassName","value":"descriptionClassName"},{"label":"disabled","value":"disabled"},{"label":"disabledOn","value":"disabledOn"},{"label":"editorSetting","value":"editorSetting"},{"label":"extraName","value":"extraName"},{"label":"hidden","value":"hidden"},{"label":"hiddenOn","value":"hiddenOn"},{"label":"hint","value":"hint"},{"label":"horizontal","value":"horizontal"},{"label":"id","value":"id"},{"label":"initAutoFill","value":"initAutoFill"},{"label":"inline","value":"inline"},{"label":"inputClassName","value":"inputClassName"},{"label":"labelAlign","value":"labelAlign"},{"label":"labelClassName","value":"labelClassName"},{"label":"labelRemark","value":"labelRemark"},{"label":"labelWidth","value":"labelWidth"},{"label":"mode","value":"mode"},{"label":"onEvent","value":"onEvent"},{"label":"placeholder","value":"placeholder"},{"label":"popOver","value":"popOver"},{"label":"quickEdit","value":"quickEdit"},{"label":"readOnly","value":"readOnly"},{"label":"readOnlyOn","value":"readOnlyOn"},{"label":"remark","value":"remark"},{"label":"required","value":"required"},{"label":"row","value":"row"},{"label":"saveImmediately","value":"saveImmediately"},{"label":"size","value":"size"},{"label":"static","value":"static"},{"label":"staticClassName","value":"staticClassName"},{"label":"staticInputClassName","value":"staticInputClassName"},{"label":"staticLabelClassName","value":"staticLabelClassName"},{"label":"staticOn","value":"staticOn"},{"label":"staticPlaceholder","value":"staticPlaceholder"},{"label":"staticSchema","value":"staticSchema"},{"label":"style","value":"style"},{"label":"submitOnChange","value":"submitOnChange"},{"label":"testIdBuilder","value":"testIdBuilder"},{"label":"text","value":"text"},{"label":"tpl","value":"tpl"},{"label":"type","value":"type"},{"label":"useMobileUI","value":"useMobileUI"},{"label":"validateApi","value":"validateApi"},{"label":"validateOnChange","value":"validateOnChange"},{"label":"validationErrors","value":"validationErrors"},{"label":"validations","value":"validations"},{"label":"value","value":"value"},{"label":"visible","value":"visible"},{"label":"visibleOn","value":"visibleOn"},{"label":"width","value":"width"},{"label":"make","value":"make"},{"label":"permission","value":"permission"},{"label":"filteredResults","value":"filteredResults"},{"label":"macro","value":"macro"},{"label":"mixin","value":"mixin"},{"label":"hasMacro","value":"hasMacro"},{"label":"flushMacros","value":"flushMacros"},{"label":"__callStatic","value":"__callStatic"},{"label":"macroCall","value":"macroCall"}],"detail_component_property":[{"name":"type","value":"static-image"},{"name":"enlargeAble","value":"1"}]},"file_column_multi":0},"排序":{"type":"integer","comment":"排序","action_scope":["list","detail","create","edit"],"file_column":0,"list_component":[],"form_component":{"form_component_type":"NumberControl","component_property_options":[{"label":"autoFill","value":"autoFill"},{"label":"big","value":"big"},{"label":"borderMode","value":"borderMode"},{"label":"className","value":"className"},{"label":"clearValueOnHidden","value":"clearValueOnHidden"},{"label":"desc","value":"desc"},{"label":"description","value":"description"},{"label":"descriptionClassName","value":"descriptionClassName"},{"label":"disabled","value":"disabled"},{"label":"disabledOn","value":"disabledOn"},{"label":"displayMode","value":"displayMode"},{"label":"editorSetting","value":"editorSetting"},{"label":"extraName","value":"extraName"},{"label":"hidden","value":"hidden"},{"label":"hiddenOn","value":"hiddenOn"},{"label":"hint","value":"hint"},{"label":"horizontal","value":"horizontal"},{"label":"id","value":"id"},{"label":"initAutoFill","value":"initAutoFill"},{"label":"inline","value":"inline"},{"label":"inputClassName","value":"inputClassName"},{"label":"keyboard","value":"keyboard"},{"label":"kilobitSeparator","value":"kilobitSeparator"},{"label":"labelAlign","value":"labelAlign"},{"label":"labelClassName","value":"labelClassName"},{"label":"labelRemark","value":"labelRemark"},{"label":"labelWidth","value":"labelWidth"},{"label":"max","value":"max"},{"label":"min","value":"min"},{"label":"mode","value":"mode"},{"label":"onEvent","value":"onEvent"},{"label":"placeholder","value":"placeholder"},{"label":"precision","value":"precision"},{"label":"prefix","value":"prefix"},{"label":"readOnly","value":"readOnly"},{"label":"readOnlyOn","value":"readOnlyOn"},{"label":"remark","value":"remark"},{"label":"required","value":"required"},{"label":"row","value":"row"},{"label":"saveImmediately","value":"saveImmediately"},{"label":"showAsPercent","value":"showAsPercent"},{"label":"showSteps","value":"showSteps"},{"label":"size","value":"size"},{"label":"static","value":"static"},{"label":"staticClassName","value":"staticClassName"},{"label":"staticInputClassName","value":"staticInputClassName"},{"label":"staticLabelClassName","value":"staticLabelClassName"},{"label":"staticOn","value":"staticOn"},{"label":"staticPlaceholder","value":"staticPlaceholder"},{"label":"staticSchema","value":"staticSchema"},{"label":"step","value":"step"},{"label":"style","value":"style"},{"label":"submitOnChange","value":"submitOnChange"},{"label":"suffix","value":"suffix"},{"label":"testIdBuilder","value":"testIdBuilder"},{"label":"type","value":"type"},{"label":"unitOptions","value":"unitOptions"},{"label":"useMobileUI","value":"useMobileUI"},{"label":"validateApi","value":"validateApi"},{"label":"validateOnChange","value":"validateOnChange"},{"label":"validationErrors","value":"validationErrors"},{"label":"validations","value":"validations"},{"label":"value","value":"value"},{"label":"visible","value":"visible"},{"label":"visibleOn","value":"visibleOn"},{"label":"width","value":"width"},{"label":"make","value":"make"},{"label":"permission","value":"permission"},{"label":"filteredResults","value":"filteredResults"},{"label":"macro","value":"macro"},{"label":"mixin","value":"mixin"},{"label":"hasMacro","value":"hasMacro"},{"label":"flushMacros","value":"flushMacros"},{"label":"__callStatic","value":"__callStatic"},{"label":"macroCall","value":"macroCall"}],"form_component_property":[{"name":"required","value":"1"},{"name":"value","value":"0"},{"name":"min","value":"0"},{"name":"max","value":"999999"},{"name":"description","value":"越大越靠前"}]},"detail_component":[],"name":"custom_order","default":"0"},"是否启用":{"type":"tinyInteger","comment":"是否启用","action_scope":["list","detail","create","edit"],"file_column":0,"list_component":{"list_component_type":"TableColumn","list_component_property":[{"name":"quickEdit","value":"{\"type\":\"switch\",\"mode\":\"inline\",\"saveImmediately\":true}"}]},"form_component":{"form_component_type":"SwitchControl","form_component_property":[{"name":"value","value":"1"}]},"detail_component":{"detail_component_type":"StaticExactControl","detail_component_property":[{"name":"type","value":"static-status"}]},"name":"enabled","default":"1","list_filter":[{"mode":"input","type":"equal","filter":{"filter_type":"SelectControl","filter_property":[{"name":"size","value":"md"},{"name":"clearable","value":"1"},{"name":"options","value":"[{\"value\":1,\"label\":\"是\"},{\"value\":0,\"label\":\"否\"}]"}]},"input_name":"enabled"}]},"多图":{"name":"images","type":"text","default":null,"nullable":true,"comment":"多图","action_scope":["list","detail","create","edit"],"file_column":true,"list_component":{"list_component_type":"TableColumn","list_component_property":[{"name":"type","value":"images"},{"name":"enlargeAble","value":"1"}]},"form_component":{"form_component_type":"ImageControl","form_component_property":[{"name":"required","value":"1"},{"name":"multiple","value":"1"}]},"detail_component":{"detail_component_type":"StaticExactControl","detail_component_property":[{"name":"type","value":"static-images"},{"name":"enlargeAble","value":"1"}]},"file_column_multi":true}}',
            'detail_component_property' => '[{"key":"StaticExactControl","value":[{"name":"type","value":"static-image"},{"name":"enlargeAble","value":"1"}],"label":"单图"},{"key":"StaticExactControl","value":[{"name":"type","value":"static-images"},{"name":"enlargeAble","value":"1"}],"label":"多图"}]',
            'filter_property'           => '[{"key":"TextControl","value":[{"name":"size","value":"md"},{"name":"clearable","value":1}],"label":"文本"},{"key":"SelectControl","value":[{"name":"size","value":"md"},{"name":"clearable","value":"1"},{"name":"options","value":"[{\"value\":1,\"label\":\"是\"},{\"value\":0,\"label\":\"否\"}]"}],"label":"是/否"}]',
            'form_component_property'   => '[{"key":"TextControl","value":[{"name":"required","value":"1"}],"label":"文本(必填)"},{"key":"NumberControl","value":[{"name":"required","value":"1"},{"name":"value","value":"0"},{"name":"min","value":"0"},{"name":"max","value":"999999"},{"name":"description","value":"越大越靠前"}],"label":"排序字段"}]',
            'list_component_property'   => '[{"key":"TableColumn","value":[{"name":"searchable","value":"1"}],"label":"文本(带搜索)"},{"key":"TableColumn","value":[{"name":"type","value":"image"},{"name":"enlargeAble","value":"1"}],"label":"单图"},{"key":"TableColumn","value":[{"name":"quickEdit","value":"{\"type\":\"switch\",\"mode\":\"inline\",\"saveImmediately\":true}"}],"label":"开关"}]',
        ];

        settings()->setMany(array_map(fn($i) => json_decode($i, true), $data));
    }
}
