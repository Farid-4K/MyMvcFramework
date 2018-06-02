<?php
namespace app\core;

require_once ROOT . '/app/config/config.php';
use app\config\Config as Config;
use app\core\View;

/**
 * Routing
 */
class Router
{
   private $routes = [];
   public function __construct()
   {
      $urls = Config::ROUTES;
      foreach ($urls as $key => $val) {
         $this->add($key, $val);
      }
   }

   public function add($route, $params)
   {
      $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
      $route = '#^' . $route . '$#';
      $this->routes[$route] = $params;
   }

   public function match()
   {
      $url = trim($_SERVER['REQUEST_URI'], '/');
      foreach ($this->routes as $route => $params) {
         if (preg_match($route, $url, $matches)) {
            foreach ($matches as $key => $match) {
               if (is_string($key)) {
                  if (is_numeric($match)) {
                     $match = (int) $match;
                  }
                  $params[$key] = $match;
               }
            }
            $this->params = $params;
            return true;
         }
      }
      return false;
   }

   public function run()
   {
      if ($this->match()) {
         $controllerPath = CONTROLLER_PATH . '\\' . $this->params['controller'] . '\\';
         $controllerPath = $controllerPath . ucfirst($this->params['action']) . 'Controller';
         if (class_exists($controllerPath)) {
            $action = $this->params['action'] . 'Action';
            if (method_exists($controllerPath, $action)) {
               $controller = new $controllerPath($this->params);
               $controller->$action();
            } else {
               View::errorCode(404);
            }
         } else {
            View::errorCode(404);
         }
      } else {
         View::errorCode(404);
      }
   }
}
