<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 28.05.2019
 * Time: 19:11
 */

namespace luxury\base;

use luxury\Db;

abstract class Model
{
    //save array of columns in db
    public $attributes = [];
    public $errors = [];
    //for validate
    public $rules = [];

    //make connection to db
    public function __construct()
    {
        Db::instance();
    }
}