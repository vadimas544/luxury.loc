<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 20.05.2019
 * Time: 18:48
 */

namespace app\controllers;


use app\controllers\AppController;

class MainController extends AppController
{
    public function indexAction()
    {
        $posts = \R::findAll('test');
        $this->setMeta('Main page', 'Description', 'Keywords');
        $name = 'John';
        $age = 30;

       $this->set(compact(posts));
    }
}