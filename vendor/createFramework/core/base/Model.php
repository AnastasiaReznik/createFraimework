<?php
namespace createFramework\base;
use createFramework\Db;
abstract class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    // подключение к бд
    public function __construct()
    {
        Db::instance();
    }
}
