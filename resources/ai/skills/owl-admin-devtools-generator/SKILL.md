---
name: owl-admin-devtools-generator
description: Use this skill for Owl Admin development tools, code generator, dynamic API templates, relationships, visual pages, generated CRUD code, app/ApiTemplates, Support/Apis, Support/CodeGenerator, Controllers/DevTools, or questions about “代码生成器”, “动态 API”, “API 模板”, “关系管理”, “可视化页面”, and “生成 CRUD”.
---

# Owl Admin DevTools Generator

用于 Owl Admin 代码生成器、动态 API、关系管理和开发者工具。

## 参考索引

需要完整路径和命令时，读取 `../_references/owl-admin-dev-index.md`。

需要按开发文档主题选择 skill 时，读取 `../_references/owl-admin-docs-map.md`。

## 优先检查

- 业务项目的 `app/ApiTemplates`
- 业务项目的 `app/Admin`
- 业务项目的 `config/admin.php`
- 框架源码的 `src/Support/Apis`
- 框架源码的 `src/Support/CodeGenerator`
- 框架源码的 `src/Controllers/DevTools`
- 框架源码的 `src/Services/AdminCodeGeneratorService.php`
- 框架源码的 `src/Services/AdminApiService.php`
- 框架源码的 `src/Services/AdminRelationshipService.php`

## 开发原则

- 动态 API 优先复用内置模板：列表、详情、新增、更新、删除、选项、设置、状态切换、聚合统计。
- 动态页面属于内置功能，低代码页面优先使用页面管理，复杂逻辑转控制器或 iframe 页面。
- 新 API 模板应实现现有模板契约，不要绕过 `AdminBaseApi` 和 `AdminApiInterface`。
- 代码生成器改动要同时检查预览、生成、清理、导入导出记录这些路径。
- 关系管理改动要确认模型命名空间、连接、字段选项和生成后的模型方法。
- 生成 CRUD 前先确认表结构、主键、时间戳、软删除和菜单信息。
- 不要在循环中做数据库结构查询或文件 IO。

## 常用入口

```bash
php artisan admin:db tables
php artisan admin:db columns table_name
php artisan admin:doctor
```

## 验证

- PHP 文件改动后执行 `php -l path/to/file.php`。
- 数据库字段相关逻辑用 `admin:db columns` 确认。
- 动态 API 变更后检查开发者工具的模板列表和参数 schema。
- 代码生成器变更后至少覆盖预览、生成、清理三个路径。
