<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 20.05.2019
 * Time: 17:51
 */

namespace luxury;


class Router
{
    protected static $routes = [];

    protected static $route = []; //current route

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(){
        return self::$routes;
    }

    public static function getRoute(){
        return self::$route;
    }
    //Get url and work with him
    public static function dispatch($url)
    {
        if(self::matchRoute($url)){
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            if(class_exists($controller)){
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if(method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                    $controllerObject->getView();
                }else{
                    throw new \Exception("Метод $action не найден.");
                }
            }else{
                throw new \Exception("Контроллер $controller  не найден.");
            }
        }else{
            throw new \Exception('Страница не найдена', 404);
        }
    }
    //get url too, and get route in routes.php
    public static function matchRoute($url)
    {
       foreach (self::$routes as $pattern => $route){
           if(preg_match("#{$pattern}#", $url, $matches)){
               foreach ($matches as $k => $v){
                   if(is_string($k)){
                       $route[$k] = $v;
                   }

               }
               if(empty($route['action'])){
                    $route['action'] = 'index';
               }
               if(!isset($route['prefix'])){
                   $route['prefix'] = '';
               }else{
                   $route['prefix'] = '\\';
               }
               $route['controller'] = self::upperCamelCase($route['controller']);
               self::$route = $route;
               return true;
           }
       }
       return false;
    }
    //for controllers naming
    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }
    //for actions naming
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }
}