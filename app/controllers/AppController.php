<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 28.05.2019
 * Time: 14:28
 */

namespace app\controllers;


use app\models\AppModel;
use luxury\base\Controller;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
    }
}