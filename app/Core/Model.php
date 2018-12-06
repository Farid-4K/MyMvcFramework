<?php

namespace App\Core;

use \Exception;
use \RedBeanPHP\R;

abstract class Model extends R
{
    /**
     * @param string $config - redBeanConfig
     * @throws \Exception
     */
    public static function connect(string $config = '')
    {
        self::setup($config || 'sqlite:../storage/database.sqlite');
        if (self::testConnection()) {
            throw new Exception("Could not establish database connection");
        }
    }
}
