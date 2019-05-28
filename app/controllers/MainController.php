<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 20.05.2019
 * Time: 18:48
 */

namespace app\controllers;


use app\controllers\AppController;
use luxury\Cache;

class MainController extends AppController
{
    public function indexAction()
    {
        $posts = \R::findAll('test');
        $this->setMeta('Main page', 'Description', 'Keywords');
        $name = 'John';
        $age = 30;
        $names = ['Andrew', 'Jane'];
        $cache = Cache::instance();
        //debug($cache);
        //$cache->set('test', $names);
        $data = $cache->get('test');
        //debug($data);

       $this->set(compact('posts'));
    }
}