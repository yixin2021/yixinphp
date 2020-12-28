<?php


use yixinphp\core\Loader;
use yixinphp\core\Application;

class BootStrap
{
    public static function run(): void
    {
        $appConfigs = Loader::config(ENV, 'app');
        if (DEBUG) {
            ini_set('display_errors', 'On');
        }
        $route = Application::getInstance();
        $route->execute($appConfigs);
    }
}