<?php


namespace yixinphp\core;

/**
 * Class Loader
 * @package yixinphp\core
 * 文件加载器
 */
class Loader
{
    static public $configs = array();

    /**
     * @param string $section
     * @param string $file
     * @return mixed|null
     * 加载配置文件
     */
    static public function config($section = 'dev', $file = '*')
    {
        if (isset(self::$configs[$section][$file])) {
            return self::$configs[$section][$file];
        }

        if ($file != '*') {
            $filePath = APP_PATH . 'configs/env/' . $section . '/' . $file . PREFIX_CONFIG;
            if (file_exists($filePath)) {
                self::$configs[$section][$file] = include $filePath;
                return isset(self::$configs[$section][$file]) ? self::$configs[$section][$file] : null;
            }
        }
    }
}