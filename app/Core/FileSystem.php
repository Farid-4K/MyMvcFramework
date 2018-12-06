<?php

namespace App\Core;

class FileSystem
{
    private static $controllers;

    private static $controllers_namespace;

    /**
     * @param string $filename
     * @param bool $array
     * @return array|\stdClass
     */
    public static function config(string $filename, bool $array = true)
    {
        $original = file_get_contents(PATH_ROOT . "/app/config/{$filename}.json");
        return json_decode($original, $array);
    }

    public static function controllers(bool $namespace)
    {
        self::$controllers_namespace = 'App\Controllers';
        self::$controllers = PATH_ROOT . "/app/Controllers/";
        return $namespace ? self::$controllers_namespace : self::$controllers;
    }
}
