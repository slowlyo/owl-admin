---
name: owl-admin-extension-module
description: Use this skill for Owl Admin extensions, modules, multi-admin setup, extension service providers, module routes, module config, menus, permissions, admin-module:init, or extensions under the configured extension directory. Trigger on 扩展, 插件, 多模块, module, extension, ServiceProvider, 菜单导入, or 模块后台.
---

# Owl Admin Extension Module

用于 Owl Admin 扩展、多模块、菜单、路由和配置开发。

## 参考索引

需要完整路径和命令时，读取 `../_references/owl-admin-dev-index.md`。

需要按开发文档主题选择 skill 时，读取 `../_references/owl-admin-docs-map.md`。

## 优先检查

- `config/admin.php`
- `app/Admin`
- `admin-modules`
- `extensions`
- `composer.json`

框架源码内可参考：

- `src/Extend`
- `src/Support/Cores/Module.php`
- `src/Console/Module`

## 开发原则

- 新模块优先使用 `php artisan admin-module:init ModuleName`。
- 扩展优先遵循 Owl Admin `Extend\ServiceProvider` 的生命周期。
- 路由、配置、语言和菜单按模块或扩展隔离。
- 菜单和权限变更要确认 URL、组件类型和父级关系。
- 不主动执行数据库清空、全量删除或 git 操作。

## 常用命令

```bash
php artisan admin-module:init ModuleName
php artisan admin-module:init-db ModuleName
php artisan admin:doctor
php artisan route:list
```

## 验证

- PHP 文件改动后执行 `php -l path/to/file.php`。
- 路由异常时执行 `php artisan route:list`。
- 安装或菜单异常时执行 `php artisan admin:doctor`。
