<?php
namespace blog\base;
use blog\Db;
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
