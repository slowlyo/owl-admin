# Owl Admin AI 开发资料

本目录由 `php artisan admin:ai-install` 生成。

## Codex

Codex 会读取项目内 `.agents/skills`。

安装完成后直接在项目根目录启动 Codex 即可。

## Cursor

Cursor 支持 `.agents/skills`。

如果还需要项目规则，执行：

```bash
mkdir -p .cursor/rules
cp .agents/adapters/cursor/owl-admin.mdc .cursor/rules/owl-admin.mdc
```

## Claude Code

复制项目规则：

```bash
cp .agents/adapters/CLAUDE.md CLAUDE.md
```

复制 Agent Skills：

```bash
mkdir -p .claude/skills
cp -R .agents/skills/* .claude/skills/
```

## Trae

复制项目规则：

```bash
mkdir -p .trae/rules
cp .agents/adapters/trae/owl-admin.md .trae/rules/owl-admin.md
```

也可以复制为 `AGENTS.md`，然后在 Trae 中开启读取 `AGENTS.md`。

```bash
cp .agents/adapters/trae/owl-admin.md AGENTS.md
```

## 使用建议

- 在 Laravel 项目根目录启动 AI 编辑器。
- 先让 AI 阅读 `config/admin.php`、`app/Admin`、`routes/admin.php`。
- 涉及页面优先使用 Owl Admin 后端 amis 渲染器。
- 涉及扩展和模块优先使用 Owl Admin 内置命令。
- 不要让 AI 编译 `vendor/slowlyo/owl-admin/admin-views`。

## 已包含的 Agent Skills

- `owl-admin-app-dev`：后台业务、CRUD、菜单、权限、助手函数、系统设置、组件管道、开发示例和 FAQ。
- `owl-admin-amis-page`：amis 页面、表单、列表、详情、筛选、操作按钮。
- `owl-admin-extension-module`：扩展、多模块、模块路由、模块配置。
- `owl-admin-devtools-generator`：代码生成器、动态 API、关系管理、开发工具。
- `owl-admin-ops-commands`：安装、升级、发布、诊断、菜单和数据库命令。
- `owl-admin-frontend-assets`：前端资源、`admin-views`、自定义前端。

公共开发索引位于 `.agents/skills/_references/owl-admin-dev-index.md`。

文档覆盖矩阵位于 `.agents/skills/_references/owl-admin-docs-map.md`。
