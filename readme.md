## 具体步骤

### way/generators插件

1.在composer.json中增加：

    "require-dev": {
        "way/generators": "~2.0"
    },

2.运行composer update安装，完成后在app/config/app.php的providers中增加：

>'Way\Generators\GeneratorsServiceProvider'

3.运行php artisan是不是多了generate选项，它可以快速地帮我们创建想要的组件。

### 安装Markdown解析插件

1 在composer.json的require中增加

> "maxhoffmann/parsedown-laravel": "dev-master"

2 然后composer update安装，在config/app.php中增加：

>        'providers' => array(
            ...
            'MaxHoffmann\Parsedown\ParsedownServiceProvider'
        ),
        'aliases' => array(
            ...
            'Markdown'        => 'MaxHoffmann\Parsedown\ParsedownFacade',
        ),
        
###安装phpunit

在composer.json的require-dev中增加

>"phpunit/phpunit": "3.7.*"

###安装扩展包

1.创建包：

>php artisan workbench hujia/notification --resources

2.修改下workbench\hujia\notification\composer.json中的authors：

    "authors": [
        {
            "name": "hujia",
            "email": "hujia7812556@gmail.com"
        }
    ]
    
3.根目录下执行：
>php artisan workbench hujia/notification --resources

4.在app/config/app.php中的providers中增加：

>'Hujia\Notification\NotificationServiceProvider',

5.启动开发服务器,如果启动成功，就说明扩展包的基础就搭建完成了。

>php artisan serve
        
### 设置本地环境

1 打开bootstrap/start.php

2 打开`'local' => array('homestead')`，将homestead改为本地主机名

3 打开app/config/local/database.php，设置mysql环境