---
name: owl-admin-frontend-assets
description: Use this skill for Owl Admin frontend assets, admin-views, public/admin-assets, resource publishing, custom React frontend work, amis-editor frontend, layout/theme frontend files, pnpm commands, or questions about “前端资源”, “admin-views”, “自定义前端”, “发布 assets”, “前端源码”, and “打包后台前端”.
---

# Owl Admin Frontend Assets

用于 Owl Admin 前端资源、`admin-views`、发布后的前端源码和自定义前端开发。

## 参考索引

需要完整路径和命令时，读取 `../_references/owl-admin-dev-index.md`。

需要按开发文档主题选择 skill 时，读取 `../_references/owl-admin-docs-map.md`。

## 路径判断

- 安装后的静态资源：`public/admin-assets`
- 安装后可发布的前端源码：`resources/admin-views`
- Composer 包内前端源码：`vendor/slowlyo/owl-admin/admin-views`
- 框架源码仓库前端源码：`admin-views`

## 开发原则

- 普通后台页面优先用后端 amis schema，不要为了页面需求直接改前端。
- 动态加载资源优先使用框架提供的 `js()`、`css()`、`styles()`、`script()` 能力。
- 前端全局函数相关需求先查退出登录、登录回调、刷新 amis 页面、刷新前端路由和关闭 tab。
- 不要编译 `vendor/slowlyo/owl-admin/admin-views`。
- 只有用户明确要自定义框架前端时，才进入 `resources/admin-views` 或框架源码 `admin-views`。
- 执行前端命令前先确认当前目录和包管理器；该项目使用 `pnpm-lock.yaml`。
- 修改前端源码后，提示用户需要重新发布或同步前端资源。

## 常用命令

```bash
php artisan admin:publish --assets
php artisan admin:publish --views
```

在确认需要构建且用户允许后，才在正确前端目录执行：

```bash
pnpm install
pnpm run dev
pnpm run build
```

## 验证

- 资源缺失先执行 `php artisan admin:doctor`。
- 前端源码变更先检查 `package.json` 和 `pnpm-lock.yaml`。
- 构建产物需要发布到 `public/admin-assets` 后才会影响运行中的后台。
