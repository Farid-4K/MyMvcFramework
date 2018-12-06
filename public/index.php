<?php

error_reporting(-1);
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define("PATH_ROOT", realpath('../'));
require_once '../vendor/autoload.php';

use App\Core\Bootstrap;

(new Bootstrap())->start();
