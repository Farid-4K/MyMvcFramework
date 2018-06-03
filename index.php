<?php
session_start();
define('ROOT', dirname(__FILE__));
require_once ROOT . '/app/vendor/autoload.php';

use app\core\Router;
use Dotenv\Dotenv;

/* Load setting */
$dotenv = new Dotenv(ROOT);
$dotenv->load();

if (DEBUG == true) {
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
   if (!function_exists('debug')) {
      function debug($str)
      {
         echo "<pre>";
         var_dump($str);
         echo "</pre>";
         die;
      }
   }
}

spl_autoload_register(
   function ($class) {
      $path = str_replace('\\', '/', ROOT . '/' . $class . '.php');
      if (file_exists($path)) {
         require_once $path;
      }
   });

/**
 * Begin work
 */

$route = new Router;
$route->run();
