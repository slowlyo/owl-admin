---
name: owl-admin-ops-commands
description: Use this skill for Owl Admin installation, publishing assets, upgrades, diagnostics, database inspection, menu maintenance, user creation, password reset, route generation, IDE helper, admin:publish, admin:install, admin:update, admin:doctor, admin:db, admin:menu, admin:create-user, or deployment troubleshooting.
---

# Owl Admin Ops Commands

用于 Owl Admin 安装、升级、诊断、资源发布和 CLI 运维。

## 参考索引

需要完整命令表时，读取 `../_references/owl-admin-dev-index.md`。

需要按开发文档主题选择 skill 时，读取 `../_references/owl-admin-docs-map.md`。

## 安装流程

```bash
composer require slowlyo/owl-admin
php artisan admin:publish
php artisan admin:install
php artisan admin:doctor
```

需要 AI 编辑器资料时：

```bash
php artisan admin:ai-install
```

## 常见任务

- 发布资源：`php artisan admin:publish`
- 只发布前端资源：`php artisan admin:publish --assets`
- 覆盖发布资源：`php artisan admin:publish --force`
- 升级：`php artisan admin:update`
- 查看升级范围：`php artisan admin:update --dry-run`
- 诊断环境：`php artisan admin:doctor`
- 查看数据库连接：`php artisan admin:db info`
- 查看菜单：`php artisan admin:menu list`
- 创建用户：`php artisan admin:create-user`
- 重置密码：`php artisan admin:reset-password`

## 安全约束

- `admin:publish --force --assets` 会清理并重发 `public/admin-assets`，执行前要确认影响范围。
- `admin:update` 可能执行迁移和资源覆盖，先用 `--dry-run` 或 `--list` 了解范围。
- `admin:menu delete`、`admin:menu import` 这类写操作优先保留确认，不要默认加 `--force`。
- 数据库排障优先使用 `admin:db` 的只读能力。
- 路由生成优先使用 `admin:gen-route --dry-run` 预览，避免覆盖自定义路由。
- 不主动执行 git commit、tag、push。

## 验证

- 安装后执行 `php artisan admin:doctor`。
- 路由问题执行 `php artisan route:list`。
- 数据库问题执行 `php artisan admin:db info`。
- 菜单问题执行 `php artisan admin:menu list`。
