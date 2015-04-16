<?php
/**
 * Created by PhpStorm.
 * User: jiahu
 * Date: 2015/4/16
 * Time: 14:58
 */
namespace Shiyanlou\Notification\Facades;

use Illuminate\Support\Facades\Facade;

class Notification extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'notification';
    }
}