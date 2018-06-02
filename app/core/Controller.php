<?php
namespace app\core;

use app\core\View;
use Exception;

/**
 * Контроллер
 */
abstract class Controller
{

   public $route;
   public $view;

   public function __construct($route)
   {
      $this->view = new View($route);
      $this->model = $this->loadModel($route['controller'], $route['action']);
   }

   /**
    * Загрузка модели
    */
   public function loadModel($controller, $action)
   {
      $path = 'app\models\\' . ucfirst($controller) . '\\' . ucfirst($action);
      if (class_exists($path)) {
         return new $path;
      }
   }

   public function accessLevelCheck($level)
   {
      $methods = [
         'public',
         'private',
         'protected',
      ];
      try {
         if (in_array($level, $methods)) {
            switch ($level) {

               case 'public':
                  continue;
                  break;

               case 'private':
                  if (!empty($_SESSION['auth'])) {
                     continue;
                  } else {
                     View::errorCode(403);
                  }
                  break;

               case 'protected':
                  if (!empty($_SESSION['private']) == true) {
                     continue;
                  } else {
                     View::errorCode(403);
                  }
                  break;
            }
         } else {
            throw new AccessException("Cannot find access level in accessLevelCheck( {$level} )");
         }
      } catch (AccessException $ex) {
         exit($ex->getMessage());
      }
   }
}

class AccessException extends Exception
{}
