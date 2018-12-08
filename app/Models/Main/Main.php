<?php

namespace App\Models\Main;

use App\Core\FileSystem;
use App\Core\Model;

/**
 * Class Main
 *
 * @package App\Models\Main
 */
class Main extends Model
{
    private $database;

    /**
     * Main constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $config = FileSystem::config('database');
        $connect = "{$config['self']}:host={$config['host']};dbname={$config['database']}";
        $this->database = $this->connect($connect, $config['user'], $config['password']);
    }

    public function writeToTable()
    {
        $post = self::dispense('post');
        $post->title = 'example';
        self::store($post);
    }
}
