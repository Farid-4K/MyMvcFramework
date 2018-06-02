<?php
namespace app\controllers\Main;

use app\core\Controller;

class DocController extends Controller
{
   public function docAction()
   {

      $vars = [
         'STYLES'  => ['materialize.css', 'intro.css'],
         'CONTENT' => 'Main/doc.html',
         'TITLE'   => 'Documentation',
         'doc'     => '/documentation',
         'title'   => 'MVC',
      ];

      echo $this->view->twig->render('default.php', $vars);
   }
}
