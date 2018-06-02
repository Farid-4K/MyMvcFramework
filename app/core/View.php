<?php
namespace app\core;

/**
 *
 */

use Twig_Environment;
use Twig_Loader_Filesystem;

class View
{

   public $path;
   public $route;
   public $loader;
   public $twig;

   public function __construct($route)
   {
      $this->route = $route;
      $this->path = $route['controller'] . '/' . $route['action'];
      $this->loader = new Twig_Loader_Filesystem(ROOT . '/app/views');
      $this->twig = new Twig_Environment($this->loader, [
         // 'cache' => ROOT . '/app/storage/cache/twig_cache/',
      ]);
   }

   /**
    * обработка HTML кодов ошибок
    */
   public static function errorCode($code)
   {
      http_response_code($code);
      $path = ROOT . '/app/views/' . $code . '.php';
      if (file_exists($path)) {
         require_once $path;
      }
      die;
   }

   /**
    * Переадресация php
    */
   public function redirect($url)
   {
      header('location:/' . $url);
      exit;
   }

   /**
    * Сообщение для ajax методов
    */
   public function message($status, $message)
   {
      exit(json_encode(['status' => $status, 'message' => $message]));
   }

   /**
    * Переадресация для ajax методов
    */
   public function location($url)
   {
      exit(json_encode(['url' => $url]));
   }
}
