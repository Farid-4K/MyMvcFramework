<?php
namespace App\Controllers\Main;

use App\Core\Controller;

class IndexController extends Controller
{
   public function indexAction()
   {
      echo $this->view->twig->render('main/index.twig');
   }
}
