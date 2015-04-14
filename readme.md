## 具体步骤

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
        
### 设置本地环境

1 打开bootstrap/start.php

2 打开`'local' => array('homestead')`，将homestead改为本地主机名

3 打开app/config/local/database.php，设置mysql环境