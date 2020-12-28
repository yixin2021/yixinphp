<?php
//定义开发环境
define('ENV', 'dev');
//定义是否开启调试模式
define('DEBUG', true);
//定义系统根目录
define('APP_ROOT', dirname(__DIR__) . '/');
//定义项目根目录
define ('APP_PATH', APP_ROOT . 'app/');
//定义配置文件后缀
define('PREFIX_CONFIG', '.config.php');
//定义控制器后缀
define('PREFIX_CONTROLLER', 'Controller.php');
//自动加载
include'../vendor/autoload.php';