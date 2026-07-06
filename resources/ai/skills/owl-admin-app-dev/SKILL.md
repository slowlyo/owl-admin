---
name: owl-admin-app-dev
description: Use this skill when developing an application that installed slowlyo/owl-admin, especially backend CRUD, menus, permissions, controllers, services, routes, config/admin.php, app/Admin, helper functions, settings(), admin_pages(), AdminPipeline, upload/file preview issues, route conflicts, custom login/menu examples, or Laravel backend code for Owl Admin. Prefer this skill even if the user only says “后台”, “菜单”, “权限”, “管理端功能”, “助手函数”, “系统设置”, “组件管道”, or “常见问题”.
---

# Owl Admin App Dev

用于安装了 `slowlyo/owl-admin` 的 Laravel 项目开发，覆盖后台业务、CRUD、核心助手、系统设置和常见问题。

## 参考索引

需要完整路径和命令时，读取 `../_references/owl-admin-dev-index.md`。

需要按开发文档主题选择 skill 时，读取 `../_references/owl-admin-docs-map.md`。

## 工作入口

先确认当前目录是业务项目根目录，再读取：

- `config/admin.php`
- `app/Admin`
- `routes/admin.php`
- `composer.json`

如果这些文件不存在，先判断 Owl Admin 是否已安装，不要直接假设目录结构。

## 开发原则

- 页面和接口优先沿用 Owl Admin 的控制器、服务层、菜单和权限体系。
- CRUD 优先查已有 `AdminController` 和业务 `Service` 写法。
- 新增、查询、编辑、删除、导出和 Service 重写都按 CRUD 文档拆分职责。
- 后台页面优先使用后端 amis schema，不要默认新建前端工程页面。
- 框架原理、助手函数、组件管道、系统设置、动态页面也归到当前后台业务上下文处理。
- 只修改和任务直接相关的文件。
- 不主动执行 git commit、tag、push。
- 不编译 `vendor/slowlyo/owl-admin/admin-views`。

## 常用路径

- `app/Admin/Controllers`
- `app/Admin/Services`
- `app/Admin/routes.php`
- `app/Admin/pages.php`
- `routes/admin.php`
- `config/admin.php`
- `app/Admin/bootstrap.php`
- `app/ApiTemplates`
- `lang/zh_CN`

## 核心能力

- `amis()`：首选组件创建入口。
- `settings()`：管理系统设置，支持缓存和模块设置。
- `admin_pages()`：读取动态页面 schema。
- `AdminPipeline`：在组件渲染前统一调整组件。
- `Admin::menu()->add()`：在 bootstrap 中动态添加菜单。
- `file_upload_handle()` / `file_upload_handle_multi()`：处理文件和图片回显。

## 示例和 FAQ

- Blade iframe 页面优先使用 `php artisan admin:make-page`。
- 条件组合查询使用 `ConditionBuilderScopeTrait` 和 ConditionBuilder 组件。
- 自定义登录页覆盖 `AuthController::loginPage()` 和登录路由。
- 自定义用户菜单覆盖 `AuthController::currentUser()` 和 `current-user` 路由。
- Excel 导入通常在列表工具栏加导入弹窗，再实现上传后的导入接口。
- 模型关联展示需要 Service 查询预加载关联，组件字段使用 `relation.field`。
- `fetchFailed` 先检查字段是否与 amis 关键字段冲突，如 `status`、`no`。
- PHP 无法读取前端运行时值，动态选项应通过 API 获取。
- 自定义路由不生效时，优先检查 resource 路由顺序和 `routes/admin.php` 是否被生成器覆盖。
- 中文配置检查 `config/app.php` 的 `locale` 和语言文件发布状态。

## 常用命令

```bash
php artisan admin:doctor
php artisan admin:menu list
php artisan admin:make-page PageName --title=页面标题 --menu
php artisan route:list
```

## 验证

- PHP 文件改动后执行 `php -l path/to/file.php`。
- 后台不可用时执行 `php artisan admin:doctor`。
- 需要确认路由时执行 `php artisan route:list`。
