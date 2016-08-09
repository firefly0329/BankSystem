<?php

class App {
    public function __construct()
    {
        $url = $this->parseUrl();

        if(is_null($url)){
            header("location:/BankSystem/Detail_Controller/detail");
        }

        $controllerName = $url[0];
        require_once "controllers/$controllerName.php";
        $controller = new $controllerName;
        $methodName = $url[1];
        unset($url[0]); unset($url[1]);

        $params = $url ? array_values($url) : array();
        call_user_func_array(array($controller, $methodName), $params);
    }

    public function parseUrl()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");//把最右邊的/刪掉
            $url = explode("/", $url);//把字串依指定的符號拆解成陣列
            return $url;
        }
    }
}