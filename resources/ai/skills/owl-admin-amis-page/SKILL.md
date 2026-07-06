---
name: owl-admin-amis-page
description: Use this skill for Owl Admin pages built with amis, including CRUD pages, forms, tables, detail pages, filters, toolbar actions, iframe pages, custom page schemas, and renderer usage. Trigger when the user mentions amis, schema, Renderers, 后台页面, 列表, 表单, 详情, 筛选, 操作按钮, or admin:make-page.
---

# Owl Admin Amis Page

用于 Owl Admin 后台页面、CRUD、表单、列表和 amis schema 开发。

## 参考索引

需要完整路径和命令时，读取 `../_references/owl-admin-dev-index.md`。

需要按开发文档主题选择 skill 时，读取 `../_references/owl-admin-docs-map.md`。

## 优先检查

- 业务项目的 `app/Admin/Controllers`
- 业务项目的 `app/Admin/Services`
- 业务项目的 `app/Admin/pages.php`
- 扩展包里的 `vendor/slowlyo/owl-admin/src/Renderers`

如果是在框架源码仓库内开发，则对应路径是 `src/Controllers`、`src/Services`、`src/Renderers`。

## 页面实现原则

- 优先使用 `amis()` 和 Owl Admin Renderer 类生成 schema。
- 组件使用优先参考页面、表单、按钮、数据展示、布局、条件显示和数据联动这些文档主题。
- Iconify、WangEditor、Watermark 等额外组件仍按 Renderer 方式使用。
- CRUD 页面优先复用 `AdminController` 的 `list()`、`form()`、`detail()` 结构。
- 数据查询、保存和校验放在 Service 或 Laravel 原生能力里，不要塞进页面 schema。
- iframe 页面优先用 `php artisan admin:make-page` 生成骨架。
- 不编译 `admin-views`，除非用户明确要求修改框架前端源码。

## 常用命令

```bash
php artisan admin:make-page PageName --title=页面标题 --menu
php artisan admin:doctor
```

## 验证

- PHP 文件改动后执行 `php -l path/to/file.php`。
- 页面路由异常时检查 `app/Admin/pages.php` 和 `routes/admin.php`。
- 菜单不显示时检查后台菜单 URL、组件类型和权限配置。
