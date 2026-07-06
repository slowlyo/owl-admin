# Owl Admin 开发索引

## 安装后的业务项目

- 配置：`config/admin.php`
- 后台目录：`app/Admin`
- 后台控制器：`app/Admin/Controllers`
- 后台服务：`app/Admin/Services`
- 后台路由：`app/Admin/routes.php`、`app/Admin/pages.php`、`routes/admin.php`
- 模块目录：`admin-modules`
- 扩展目录：`extensions`
- 自定义动态 API 模板：`app/ApiTemplates`
- 发布后的前端源码：`resources/admin-views`
- 发布后的前端资源：`public/admin-assets`
- 开发示例和 FAQ：`.agents/skills/owl-admin-app-dev`

## 框架源码对应路径

- 服务提供者：`src/AdminServiceProvider.php`
- 控制器基类：`src/Controllers/AdminController.php`
- 服务基类：`src/Services/AdminService.php`
- amis 渲染器：`src/Renderers`
- 动态 API 模板：`src/Support/Apis`
- 代码生成器：`src/Support/CodeGenerator`
- 开发工具控制器：`src/Controllers/DevTools`
- 菜单、路由、模块、权限核心：`src/Support/Cores`
- 扩展生命周期：`src/Extend`
- Artisan 命令：`src/Console`
- 前端源码：`admin-views`
- 文档站源码：仓库根目录 `docs/docs`

## 常用命令

```bash
php artisan admin:publish
php artisan admin:install
php artisan admin:update
php artisan admin:doctor
php artisan admin:check --zh
php artisan admin:db info
php artisan admin:menu list
php artisan admin:make-page PageName --title=页面标题 --menu
php artisan admin-module:init ModuleName
php artisan admin:ai-install
```

## 命令用途

- `admin:publish`：发布资源、配置、语言、前端源码。
- `admin:install`：执行迁移并生成 `app/Admin` 骨架。
- `admin:update`：执行版本升级脚本。
- `admin:doctor`：检查 APP_KEY、数据库、核心表、菜单、前端资源。
- `admin:check`：旧版基础环境检查。
- `admin:db`：只读查看 Owl Admin 使用的数据库。
- `admin:menu`：用 CLI 查看、创建、更新、删除、导入、导出菜单。
- `admin:make-page`：生成 iframe 页面控制器、视图、路由和菜单。
- `admin-module:init`：初始化多模块后台。
- `admin-module:init-db`：重建模块数据表。
- `admin:create-user`：创建后台用户。
- `admin:reset-password`：重置后台用户密码。
- `admin:gen-route`：生成后台路由文件。
- `admin:ide-helper`：生成 IDE 辅助提示。

## 开发原则

- 先读现有代码，再决定改哪里。
- 页面优先用后端 amis schema 和 Renderer。
- CRUD 优先复用 `AdminController`、`AdminService`。
- 数据库和菜单操作优先使用框架命令或服务。
- 不主动执行 git commit、tag、push。
- 不编译 `vendor/slowlyo/owl-admin/admin-views`。
- 修改 PHP 后优先执行 `php -l path/to/file.php`。
