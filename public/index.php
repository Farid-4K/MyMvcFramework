<?php

error_reporting(-1);
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once '../vendor/autoload.php';

use App\Core\Router;
use Dotenv\Dotenv;

(new Dotenv('../'))->load();
(new Router())->run();
