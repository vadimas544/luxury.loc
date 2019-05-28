<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 28.05.2019
 * Time: 20:05
 */

namespace luxury;


class Cache
{
    use TSingleton;

    //set to cache
    public function set($key, $data, $seconds = 3600)
    {
        if($seconds){
            $content['data'] = $data;
            $content['end_time'] = time() + $seconds;
            if(file_put_contents(CACHE . '/'. md5($key). '.txt', serialize($content))){
                return true;
            }
        }
        return false;
    }
    //get from cache
    public function get($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if(file_exists($file)){
            $content = unserialize(file_get_contents($file));
            if(time() <= $content['end_time']){
                return $content;
            }
            unlink($file);
        }
        return false;
    }

    //delete from cache
    public function delete($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if(file_exists($file)){
            unlink($file);
        }
    }
}