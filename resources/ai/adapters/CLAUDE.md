# Owl Admin 项目规则

## 项目识别

- Owl Admin 是 Laravel 扩展包，业务项目通常通过 `composer require slowlyo/owl-admin` 安装。
- 安装后后台业务代码通常在 `app/Admin`。
- 后台路由通常在 `routes/admin.php`、`app/Admin/routes.php`、`app/Admin/pages.php`。
- 后台配置通常在 `config/admin.php`。
- 动态 API 模板通常在 `app/ApiTemplates`。
- 多模块通常在 `admin-modules`。
- 扩展通常在 `extensions`。
- 前端资源来自扩展包，不要编译 `vendor/slowlyo/owl-admin/admin-views`。

## 开发约束

- 先读现有控制器、服务、模型、路由和配置，再改代码。
- 页面优先用后端 amis 渲染器和 `amis()`，不要直接手写前端页面。
- CRUD 功能优先复用 `AdminController`、`AdminService`、菜单和权限能力。
- 代码生成器、动态 API、关系管理优先查 Owl Admin 开发者工具和内置模板。
- 框架原理、助手函数、组件管道、系统设置、动态页面、开发示例和常见问题都归入后台业务开发规则。
- 扩展和多模块优先使用官方命令与既有目录结构。
- 安装、发布、升级、菜单、数据库排障优先使用 Owl Admin Artisan 命令。
- 不要主动执行 git commit、tag、push。
- 不要修改无关文件。

## 常用命令

```bash
php artisan admin:publish
php artisan admin:install
php artisan admin:doctor
php artisan admin:db info
php artisan admin:menu list
php artisan admin:make-page PageName --title=页面标题 --menu
php artisan admin-module:init ModuleName
```

## 文档主题覆盖

- 基础：安装、升级、框架原理、助手函数、内置命令、组件使用。
- CRUD：基础、新增、查询、编辑、删除、Service 重写、导出、组件管道。
- 内置功能：代码生成器、动态 API、动态页面、动态关联、系统设置。
- 前端：前端源码、动态加载资源、全局函数、前后端独立部署。
- 扩展模块：扩展使用、开发、配置、示例和多模块。
- 示例 FAQ：iframe 页面、组件封装、条件查询、自定义登录、动态菜单、Excel 导入、路由冲突、上传回显和中文配置。

## 验证建议

- PHP 文件改动后执行 `php -l path/to/file.php`。
- 安装或部署异常先执行 `php artisan admin:doctor`。
- 不要执行前端 build，除非用户明确要求并确认目录。
