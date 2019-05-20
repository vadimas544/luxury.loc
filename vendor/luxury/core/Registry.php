<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 20.05.2019
 * Time: 15:39
 */

namespace luxury;


class Registry
{
    //Realize pattern Singleton
    use TSingleton;

    //Container for properties our $app

    public static $properties = [];

    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;//save our value into name property
    }

    public function getProperty($name)
    {
        if(isset(self::$properties[$name])){
            return self::$properties[$name];
        }
        return null;
    }
    //Method for debug
    public function getProperties(){
        return self::$properties;
    }
}