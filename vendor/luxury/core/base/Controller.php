<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 28.05.2019
 * Time: 14:19
 */

namespace luxury\base;


abstract class Controller
{
    public $route;
    public $controller;
    public $view;
    public $model;
    public $prefix;
    public $data = [];//our data
    public $meta = ['title' => '', 'keywords' => '', 'desc' => ''];//metadata(title, description, keywords)
    public $layout;

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    //Method for metadata
    public function setMeta($title = '', $desc = '', $keywords = '')
    {
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
        $this->meta['keywords'] = $keywords;
    }

    public function set($data)
    {
        $this->data = $data;
    }

    //get view and call method render in controller
    public function getView()
    {
        $viewObject = new View($this->route,$this->layout, $this->view, $this->meta);//create
        $viewObject->render($this->data);
    }


}