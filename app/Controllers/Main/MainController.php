<?php

namespace App\Controllers\Main;

use App\Core\Controller;

class MainController extends Controller
{
    public function index()
    {
        return $this->view->render('main/index.twig');
    }
}
