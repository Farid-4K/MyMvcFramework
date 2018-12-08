<?php

namespace App\Core;

use Dotenv\Dotenv;

/**
 * Class Bootstrap
 *
 * @package App\Core
 */
class Bootstrap
{
    private $router;

    private $config;

    /**
     * Start application
     *
     * @return Bootstrap
     */
    public function start(): Bootstrap
    {
        $this->config = new Dotenv(PATH_ROOT);
        $this->config->load();

        self::errors();

        $this->router = new Router();
        $this->router->processing();
        return $this;
    }

    /**
     * Enable errors if need
     *
     * @return void
     */
    private static function errors(): void
    {
        if (Helpers::env('APP_DEBUG')) {
            error_reporting(-1);
            ini_set('error_reporting', -1);
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
        }
    }
}
