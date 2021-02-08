<?php
namespace createFramework;
class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
    }

    //обрабатыает перехваченное исключение из конструктора - запись ошибки в файл и показ на экране
    public function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        // echo'urtiertie';
        // debug($e);
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    //логирование ошибок, запись ошибки в файл
    protected function logErrors($message = '', $file = '', $line = '')
    {
        $date = date('d.m.Y h:i:s');

        error_log("$date | Текст ошибки: {$message} | Файл: {$file} | Строка: {$line}\n==========================\n", 3,ROOT . '/tmp/errors.log');
    }

    //метод для показа ошибок на экране
    protected function displayError($errno, $errstr,  $errfile, $errline, $responce=404)
    {
        // echo $responce;
        // echo DEBUG;
        // функ-я отправить заголовок тот код, который передам в параметр
        http_response_code($responce);

        //если мы НЕ в режиме разработчика
        if ($responce == 404  AND !DEBUG) {
            require WWW . '/errors/404.php';
            die;
        }
        if (DEBUG) {
            require WWW . '/errors/dev.php';
        }else {
            require WWW . '/errors/prod.php';
        }
    }
}

