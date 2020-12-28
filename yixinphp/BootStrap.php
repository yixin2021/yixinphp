<?php


use yixinphp\core\Loader;
use yixinphp\core\Application;
use yixinphp\db\Db;
use yixinphp\exception\ExceptionHandle;

/**
 * Class BootStrap
 *  框架启动类
 */
class BootStrap
{
    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public static function run(): void
    {
        self::init();
        $appConfigs = Loader::config(ENV, 'app');
        $route = Application::getInstance();
        $route->execute($appConfigs);
    }

    /**
     * 初始化
     * @throws Exception
     */
    public static function init()
    {
        ExceptionHandle::init();

        Db::init();
    }
}