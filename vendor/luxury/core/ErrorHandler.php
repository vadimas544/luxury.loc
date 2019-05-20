<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 20.05.2019
 * Time: 16:13
 */

namespace luxury;


class ErrorHandler
{
    public function __construct()
    {
        //We need to know our constant DEBUG
        if(DEBUG){
            error_reporting(-1);
        }else{
            error_reporting(0);
        }
        //function for handliing for exceptions
        set_exception_handler([$this, 'exceptionHandler']); //$this(method based in this class, 'exceptionHandler' -name of method)
    }

    public function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    public function logErrors($message = '', $file = '', $line = '')
    {
        error_log("[" . date('Y-m-d H:i:s') . "] Текст ошибки: {$message} | Файл: {$file} | Строка: {$line}\n===========\n", 3, ROOT.'/tmp/errors.log');
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $response = 404)
    {
        http_response_code($response);//send this response code
        if($response == 404 && !DEBUG){
            require_once WWW . '/errors/404.php';
            die;
        }
        if(DEBUG){
            require_once WWW . '/errors/dev.php';
        }else{
            require_once WWW . '/errors/prod.php';
        }

    }

}