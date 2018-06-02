<?php
namespace app\controllers;

use app\core\Controller;

/**
 * Контроллер - обработчик событий
 */
class %Controller extends Controller
{
   public function %Action()
   {
      /**
       * Проверка уровня доступа
       * public , private, protected
       */
      $this->accessLevelCheck('protected');

      $vars = [
         'STYLES' => ['materialize.css'],
         // 'CONTENT'   => 'Admin/home.html',
         'TITLE'  => 'Admin',
      ];

      /* Выбор и рендер шаблона */
      echo $this->view->twig->render('default.php', $vars);
   }
}
