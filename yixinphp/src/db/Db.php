<?php


namespace yixinphp\db;
use Illuminate\Database\Capsule\Manager as Capsule;
use yixinphp\core\Loader;

class Db
{
    private static $capsule = null;

    /**
     * 初始化
     */
    public static function init()
    {
        if (is_null(self::$capsule)) {
            self::$capsule = new Capsule;
        }
        $config = Loader::config(ENV, 'db');
        self::$capsule->addConnection($config);
        self::$capsule->bootEloquent();
    }
}