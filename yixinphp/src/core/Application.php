<?php

namespace yixinphp\core;

use ReflectionClass;
use yixinphp\http\Request;

/**
 * Class Application
 * @package yixinphp\core
 */
class Application
{

    /** @var Request $request */
    private $request;

    /**
     * @var array
     * url参数
     */
    private $params = array();

    private static $instance = null;

    public function __construct()
    {
    }

    /**
     * @return Application|null
     * 获取路由实例
     */
    public static function getInstance(): ?Application
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $configs
     * @throws \ReflectionException
     * @throws \Exception
     * 执行方法
     */
    public function execute($configs)
    {
        $this->requestInit($configs);
        $filePath = APP_PATH . 'modules/' . $this->request->getModule() . '/controller/' . $this->request->getController() . PREFIX_CONTROLLER;
        if (file_exists($filePath)) {
            $className = "app\\modules\\{$this->request->getModule()}\\controller\\" . ucfirst($this->request->getController()) . 'Controller';
            $reflect = new ReflectionClass($className);
            if($reflect->hasMethod($this->request->getMethod())) {
                $class = $reflect->newInstance();
                $method = $this->request->getMethod();
                $class->$method();
            } else {
                throw new \Exception("方法{$this->request->getMethod()}不存在");
            }
        } else {
            throw new \Exception("控制器{$this->request->getController()}Controller不存在");
        }
    }

    /**
     * @param $config
     * 初始化请求
     */
    private function requestInit($config)
    {
        $this->request = new Request();
        $this->request->init($config);
    }
}