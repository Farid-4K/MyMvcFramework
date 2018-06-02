<?php
namespace app\controllers\Main;

use app\core\Controller;

class IndexController extends Controller
{
   public function indexAction()
   {
      $vars = [
         'STYLES'    => ['materialize.css', 'intro.css'],
         'TITLE'     => 'Mvc',
         'CONTENT'   => 'Main/index.html',
         'title'     => 'MVC',
         'doc'       => '/documentation',
         'structure' => '/structure',
         'data'      => $this->route['controller'],
      ];

      echo $this->view->twig->render('default.php', $vars);
   }
}
