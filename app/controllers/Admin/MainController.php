<?php
namespace app\controllers\Admin;

use app\core\Controller;

class MainController extends Controller
{
   public function mainAction()
   {
      $this->accessLevelCheck('protected');

      $vars = [
         'STYLES'    => ['style.css', 'intro.css', 'admin.css', 'materialize.css'],
         'CONTENT'   => 'Admin/home.html',
         'TITLE'     => 'Admin',
         'html_menu' => 'Admin/menu.html',
      ];

      if (!empty($_POST['admin_exit'])) {
         if ($this->model->adminExit()) {
            $this->view->location('admin');
         }
      }

      echo $this->view->twig->render('default.php', $vars);
   }
}
