<?php
namespace app\controllers\Admin;

use app\core\Controller;

class HomeController extends Controller
{
   public function homeAction()
   {
      $this->accessLevelCheck('public');
      $vars = [
         'STYLES'         => ['materialize.css', 'intro.css', 'admin.css', 'style.css'],
         'CONTENT'        => 'Admin/index.html',
         'TITLE'          => 'Admin',
         'input_login'    => 'login',
         'input_password' => 'password',
      ];

      if (!empty($_POST)) {
         if ($this->model->signIn($_POST)) {
            $this->view->location('admin/main');
         }
      }

      echo $this->view->twig->render('default.php', $vars);
   }
}
