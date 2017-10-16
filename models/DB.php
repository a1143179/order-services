<?php

namespace Model;
use \PDO;

class DB
{
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    private function __construct()
    {}

    public static function getInstance()
    {
        static $db;
        if (empty($db)) {
            $db = new PDO('mysql:host=127.0.0.1;dbname=order-services', self::DB_USERNAME, self::DB_PASSWORD);
        }
        return $db;
    }
}