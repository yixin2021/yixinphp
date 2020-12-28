<?php


namespace yixinphp\http;

/**
 * Class Request
 * @package yixinphp\http
 * http请求
 */
class Request
{

    public function __construct()
    {
    }

    /**
     * 模块
     */
    private $module;

    /**
     * 控制器
     */
    private $controller;

    /**
     * 方法
     */
    private $method;

    /**
     * @var array
     * 参数
     */
    private $params = array();

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module): void
    {
        $this->module = $module;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller): void
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method): void
    {
        $this->method = $method;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params ?? [];
    }

    /**
     * @param array $params
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    /**
     * @param $configs
     * 初始化请求
     */
    public function init($configs)
    {
        $requestUrl = trim($_SERVER['REQUEST_URI'], "/");
        $paths = parse_url($requestUrl);
        if (!is_null($paths)) {
            //设置模块、控制器、方法
            $urlArray = explode('/', $paths['path']);
            if (count($urlArray) === 3) {
                $this->setModule($urlArray[0]);
                $this->setController($urlArray[1]);
                $this->setMethod($urlArray[2]);
            } else {
                $this->setModule($configs['default_url']['module']);
                $this->setController($urlArray[0]);
                $this->setMethod($urlArray[1]);
            }
            //处理url参数
            $params = $_GET + $_POST;
            $this->setParams($params);
        } else {
            //默认访问admin/index/index
            $this->setModule($configs['default_url']['module']);
            $this->setController($configs['default_url']['controller']);
            $this->setMethod($configs['default_url']['method']);
        }
    }

    /**
     * @param $name
     * @return mixed
     * 获取参数值
     */
    public function getParam($name) {
        return isset($this->params[$name]) ? $this->params[$name] : null;
    }
}