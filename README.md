<div align="center">
    <br/>
    <img src="https://slowlyo.gitee.io/static/images/owl-admin/logo.png" alt="" />
    <h1 align="center">
        Owl Admin
    </h1>
    <h4 align="center">
        快速且灵活的后台框架
    </h4> 

[官网](https://owladmin.com) | [Demo](http://demo.owladmin.com) | [Github](https://github.com/Slowlyo/owl-admin) | [Gitee](https://gitee.com/slowlyo/owl-admin) | [文档](http://doc.owladmin.com) | [论坛](https://discuss.owladmin.com) | [加群](http://qm.qq.com/cgi-bin/qm/qr?_wv=1027&k=ftIIJ4kKr72mvBpoA7-ttvFafvKuu3F8&authKey=Y2nBcGpw%2FDxJ1V4jPtSyQgDJzTZXB2KEVQOm1mKYyxuVbM9SOEkQN4Mbhm%2BsAlTr&noverify=0&group_code=754544686)

</div>

<p align="center">
    <a href="https://www.php.net/">
        <img src="https://img.shields.io/badge/PHP-8.0%2B-%23268af1" alt="Pear Admin Layui Version">
    </a>
&nbsp;
    <a href="https://laravel.com/">
        <img src="https://img.shields.io/badge/Laravel-9.0%2B-%23268af1" alt="Jquery Version">
    </a>
&nbsp;
      <a href="https://aisuda.bce.baidu.com/amis/zh-CN/docs/index">
        <img src="https://img.shields.io/badge/Amis-3.0%2B-%23268af1" alt="Layui Version">
    </a>
&nbsp;
      <a href="https://packagist.org/packages/slowlyo/owl-admin">
        <img src="https://img.shields.io/badge/license-MIT-%23268af1" alt="Layui Version">
    </a>
</p>

<br>

<div align="center">
  <img  width="92%" style="border-radius:4px;margin-top:20px;margin-bottom:20px;box-shadow: 2px 0 6px gray;" src="https://slowlyo.gitee.io/static/images/owl-admin/home-page1.png" />
</div>
<br>

### 项目介绍

基于 `Laravel` 、 `amis` 开发的后台框架, 快速且灵活~

- 基于 amis 以 json 的方式构建页面，减少前端开发工作量，提升开发效率。
- 在 amis 100多个组件都不满足的情况下, 可自行开发前端。
- 框架为前后端分离 (不用再因为框架而束手束脚~)。

<br>

### 内置功能

- 基础后台功能
    - 后台用户管理
    - 角色管理
    - 权限管理
    - 菜单管理
- **代码生成器**
    - 创建数据迁移文件
    - 创建数据表
    - 创建模型
    - 创建基础控制器代码
    - 创建Service
    - 保存生成记录
    - 导入/导出生成记录
    - 可使用命令清除生成的内容
    - 无需更改代码即可生成完整功能
- `Amis` 全组件封装 120+
- 扩展管理

<br>

### 截图

![登录](https://slowlyo.gitee.io/static/images/owl-admin/_login.png)
![首页](https://slowlyo.gitee.io/static/images/owl-admin/_home.png)
![可视化编辑器](https://slowlyo.gitee.io/static/images/owl-admin/_editor.png)

<br>

### 安装

1. 创建 `Laravel` 项目

```php
composer create-project laravel/laravel example-app
```

2. 配置数据库信息

```dotenv
# .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=owl_admin
DB_USERNAME=root
DB_PASSWORD=
```

如果有需要的话，在此时可以在`config/app.php`设置中文
locale如下设置
```
'locale' => 'zh_CN',
```


3. 获取 `Owl Admin`

```shell
composer require slowlyo/owl-admin
```

4. 安装

```shell
# 发布资源
php artisan admin:publish
# 安装 (可以在执行安装命令前在 config/admin.php 中修改部分配置)
php artisan admin:install
```


上述步骤操作完成之后就可以配置 web 服务了，注意需要把 web 目录也就是运行目录指向 public 目录！

如果用的是 nginx，还需要在配置中加上伪静态配置
```shell
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

另外注意文件权限设置755，否则可能报错



5. 运行项目

> 启动服务, 访问 `/admin` 路由即可 <br>
> 初始账号密码都是 `admin`

<br>

### 支持项目

如果觉得项目不错，或者已经在使用了，希望你可以去 [Github](https://github.com/Slowlyo/owl-admin)
或者 [Gitee](https://gitee.com/slowlyo/owl-admin) 帮我们点个 ⭐ Star，这将是对我们极大的鼓励与支持。

<br>
<br>

感谢 [__JetBrains__](https://jb.gg/OpenSourceSupport) 提供的 `IDE` 支持

<img src="https://resources.jetbrains.com/storage/products/company/brand/logos/jb_beam.png?_gl=1*cg0jw0*_ga*NTA2ODgwODQyLjE2NTU3MzAyNTI.*_ga_9J976DJZ68*MTY4NTUzNjY1Ny4xMS4xLjE2ODU1MzY2NjAuMC4wLjA.&_ga=2.105214851.1872617824.1685460785-506880842.1655730252" width="50px">
