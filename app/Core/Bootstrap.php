<?php
namespace App\Core;

use Dotenv\Dotenv;

class Bootstrap
{
    private $router;

    private $config;

    public function start()
    {
        $this->config = new Dotenv(PATH_ROOT);
        $this->config->load();
        $this->router = new Router();
        $this->router->processing();
    }
}
