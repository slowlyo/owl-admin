# Slow Admin

***
基于 `Laravel` 、 `Ant Design Pro`、 `amis` 开发的后台框架.

### Laravel

Laravel 是一个全栈Web应用程序框架，具有富有表现力、优雅的语法。

### Ant Design Pro
Ant Design Pro 是基于 Ant Design 和 umi 的封装的一整套企业级中后台前端/设计解决方案

### amis

amis 是一个低代码前端框架，它使用 JSON 配置来生成页面，可以减少页面开发工作量，极大提升效率。

## 文档

***

- [《Laravel 9 中文文档》](https://learnku.com/docs/laravel/9.x/installation/12200)
- [《amis》](https://aisuda.bce.baidu.com/amis/zh-CN/docs/index)
- [《Slow Admin》](https://www.yuque.com/slowlyo/slow-admin-doc)

## 功能

***

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
- `Amis` 全组件封装

## demo
[Demo 地址](http://admin-demo.slowlyo.top)

## 截图

***
![首页](https://cdn.learnku.com/uploads/images/202211/12/80143/pMvP309qsl.png!large)
![管理员](https://cdn.learnku.com/uploads/images/202211/12/80143/QX1aJissgK.png!large)
![代码生成器](https://cdn.learnku.com/uploads/images/202211/12/80143/GYqUIenDBA.png!large)

## 环境

***

- PHP >= 8.0
- Laravel 9

## 一分钟跑起来

***

1. 安装 `Laravel`

```php
composer create-project laravel/laravel example-app
```

2. 配置 `.env`

```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=slow_admin
DB_USERNAME=root
DB_PASSWORD=
```

3. 获取 `Slow Admin`

```php
composer require slowlyo/slow-admin
```

4. 发布资源

```php
php artisan vendor:publish --provider="Slowlyo\SlowAdmin\SlowAdminServiceProvider" --force
```

5. 安装

```php
php artisan admin:install
```

6. 运行项目

> 在你的环境把代码跑起来 <br>
> 或者在 `laravel` 目录执行 `php artisan serve` <br>
> 在浏览器打开 `http://localhost/admin` 即可访问 <br>
> 初始账号密码都是 `admin`

## 鸣谢

***

- [Laravel](https://laravel.com)
- [Ant Design Pro](https://pro.ant.design)
- [amis](https://github.com/baidu/amis)
- [Laravel-admin](https://www.laravel-admin.org/)
- [Dcat Admin](https://github.com/jqhph/dcat-admin)
- [Amis Admin](https://github.com/SmallRuralDog/amis-admin)
