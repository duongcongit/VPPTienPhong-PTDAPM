<?php
class App
{

    private $__controller;
    private $__action;
    private $__params;

    function __construct()
    {
        $this->__controller = 'Home';
        $this->__action = 'index';
        $this->__params = [];
        $this->handleUrl();
    }

    function getUrl()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }

        return $url;
    }

    public function handleUrl()
    {
        $url = $this->getUrl();
        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);

        if (!empty($urlArr[0])) {
            $this->__controller = ucfirst($urlArr[0]);
        }

        if (file_exists('app/controllers/' . $this->__controller . 'Controller.php')) {
            require_once 'controllers/' . $this->__controller . 'Controller.php';
            $this->__controller = new $this->__controller();
            unset($urlArr[0]);
        } else {
            echo "Lỗi!";
        }

        // Xử lý action
        if (!empty($urlArr[1])) {
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }
        else{
            // $this->__controller->index();
        }

        // Xử lý params
        $this->__params = array_values(($urlArr));


        call_user_func_array([$this->__controller, $this->__action], $this->__params);


    }

    public function loadError($name = '404')
    {
        require_once './errors' . $name . '.php';
    }
}
