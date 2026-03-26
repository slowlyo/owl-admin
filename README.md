<div align="center">
    <br/>
    <img src="https://doc.owladmin.com/static/images/demo/logo.png" alt="" />
    <h1 align="center">
        Owl Admin
    </h1>
    <h4 align="center">
        快速且灵活的后台框架
    </h4> 

[官网](https://owladmin.com) | [Demo](http://demo.owladmin.com) | [Github](https://github.com/Slowlyo/owl-admin) | [Gitee](https://gitee.com/slowlyo/owl-admin) | [文档](http://owladmin.com) [(备用文档)](https://owl-admin.github.io/docs/) | [加群](https://jq.qq.com/?_wv=1027&k=5La4Ir6c)

</div>

<p align="center">
    <a href="https://www.php.net/">
        <img src="https://img.shields.io/badge/PHP-8.2%2B-%23268af1" alt="">
    </a>
&nbsp;
    <a href="https://laravel.com/">
        <img src="https://img.shields.io/badge/Laravel-11.x%20--%2013.x-%23268af1" alt="">
    </a>
&nbsp;
      <a href="https://aisuda.bce.baidu.com/amis/zh-CN/docs/index">
        <img src="https://img.shields.io/badge/Amis-3.0%2B-%23268af1" alt="">
    </a>
&nbsp;
      <a href="https://packagist.org/packages/slowlyo/owl-admin">
        <img src="https://img.shields.io/badge/license-MIT-%23268af1" alt="">
    </a>
</p>

<br>

<div align="center">
  <img  width="92%" style="border-radius:4px;margin-top:20px;margin-bottom:20px;box-shadow: 2px 0 6px gray;" src="https://doc.owladmin.com/static/images/demo/home.png" />
</div>
<br>

### 项目介绍

基于 `Laravel` 、 `amis` 开发的后台框架, 快速且灵活~

当前版本支持 `Laravel 11.x - 13.x`。

- 基于 amis 以 json 的方式在后端构建页面，减少前端开发工作量，提升开发效率。
- 在 amis 150多个组件都不满足的情况下, 可自行开发前端。
- 框架为前后端分离 (不用再因为框架而束手束脚~)。

<br>

### 内置功能

- 基础后台功能
    - 后台用户管理
    - 角色管理
    - 权限管理
    - 菜单管理
- **代码生成器**
    - 保存生成记录
    - 导入/导出生成记录
    - 可使用命令清除生成的内容
    - 无需更改代码即可生成完整功能
- `amis` 全组件封装 150+ , 无需前端开发即可完成复杂页面
- 多模块支持
- 图形化扩展管理
- 动态 API 模板管理（CRUD / 选项 / 设置 / 状态切换 / 聚合统计）

<br>

### 截图

![登录](https://doc.owladmin.com/static/images/demo/login.png)
![首页](https://doc.owladmin.com/static/images/demo/home.png)
![可视化编辑器](https://doc.owladmin.com/static/images/demo/editor.png)

<br>

### 安装

> 👉 __注意: `OwlAdmin` 是 `laravel` 的扩展包, 安装前请确保你会使用 `laravel`__

##### 1. 创建 `laravel` 项目

```php
composer create-project laravel/laravel example-app
```

##### 2. 配置数据库信息并安装 API 模块

```dotenv
# .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=owl_admin
DB_USERNAME=root
DB_PASSWORD=
```

安装 API 模块 (Laravel 11+)

```shell
php artisan install:api
```

##### 3. 获取 `Owl Admin`

```shell
composer require slowlyo/owl-admin
```

##### 4. 安装

```shell
# 先发布框架资源
php artisan admin:publish
# 执行安装 (可以在执行安装命令前在 config/admin.php 中修改部分配置)
php artisan admin:install
```

##### 5. 运行项目

启动服务, 访问 `/admin` 路由即可 <br>
_初始账号密码都是 `admin`_

<br>

### 支持项目

你可以通过以下方式支持项目:

- 报告 Bug
- 提交 PR
  - 参见 [贡献文档](https://github.com/Slowlyo/owl-admin/blob/master/CONTRIBUTING.md)
- 点点 Star 
    - 如果觉得项目不错，或者已经在使用了，希望你可以去 [Github](https://github.com/Slowlyo/owl-admin)
或者 [Gitee](https://gitee.com/slowlyo/owl-admin) 帮我们点个 ⭐ Star，这将是对我们极大的鼓励与支持。

[![Stargazers over time](https://starchart.cc/Slowlyo/owl-admin.svg?variant=adaptive)](https://github.com/Slowlyo/owl-admin)
