<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 28.05.2019
 * Time: 14:34
 */

namespace luxury\base;


use Exception;

class View
{
    public $route;
    public $controller;
    public $view;
    public $model;
    public $prefix;
    public $data = [];//our data
    public $meta = [];//metadata(title, description, keywords)
    public $layout;

    public function __construct($route, $layout = '', $view = '', $meta)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        if($layout === false){
            $this->layout = false;
        }else{
            $this->layout = $layout ? $layout : LAYOUT;
        }
    }

    public function render($data)
    {
        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";
        if(is_file($viewFile)){
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        }else{
            throw new \Exception("Не найден вид {$viewFile}", 404);
        }

        if(false !== $this->layout){
            $layoutFile = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($layoutFile)){
                require_once $layoutFile;
            }else{
                throw new \Exception("Файл {$layoutFile} не является шаблоном", 404);
            }
        }
    }

    public function getMeta()
    {
        
    }
}