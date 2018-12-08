<?php

define("PATH_ROOT", realpath('../'));
define("START_TIME", microtime(true));

require_once '../vendor/autoload.php';

use App\Core\Bootstrap;

(new Bootstrap())->start();
