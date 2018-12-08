<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Class FileSystem
 *
 * @package App\Core
 */
class FileSystem
{
    private static $controllers;

    private static $controllers_namespace;
    private static $models_namespace;
    private static $models;

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

    /**
     * @param bool $namespace
     * @return string
     */
    public static function controllers(bool $namespace): string
    {
        self::$controllers_namespace = 'App\Controllers';
        self::$controllers = PATH_ROOT . "/app/Controllers/";
        return $namespace ? self::$controllers_namespace : self::$controllers;
    }

    /**
     * @param bool $namespace
     * @return string
     */
    public static function models(bool $namespace): string
    {
        self::$models_namespace = 'App\Models';
        self::$models = PATH_ROOT . "/app/Models/";
        return $namespace ? self::$models_namespace : self::$models;
    }
}
