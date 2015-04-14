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