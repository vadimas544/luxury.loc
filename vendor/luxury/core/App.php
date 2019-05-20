<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 20.05.2019
 * Time: 15:31
 */

namespace luxury;


class App
{
    public static $app;

    public function __construct()
    {
        $query = trim($_SERVER['QUERY_STRING'], '/');
        session_start();
        self::$app = Registry::instance();// now $app is container where we have object our Registry with properties
        $this->getParams();
        new ErrorHandler();
    }

    protected  function getParams()
    {
        $params = require_once CONFIG . '/params.php';
        if(!empty($params)){
            foreach ($params as $k => $v){
                self::$app->setProperty($k, $v);
            }
        }
    }
}