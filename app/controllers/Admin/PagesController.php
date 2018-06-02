<?php
namespace app\controllers\Admin;

use app\core\Controller;

class PagesController extends Controller
{
   public function pagesAction()
   {
      $this->accessLevelCheck('protected');

      $aboutRouting = $this->model->getPages();

      $vars = [
         'data' => $aboutRouting,
      ];

      if (!empty($_POST['url'])) {
         try {
            if ($this->model->createFiles($_POST)) {
               $this->view->message('Успешно', 'Роут и контроллер созданы');
            } else {
               $this->view->message('error', $this->model->error);
            }
         } catch (LossArgumentException $e) {
            echo $e->getMessage();
         }
      }

      echo $this->view->twig->render('Admin/pages.html', $vars);
   }
}
