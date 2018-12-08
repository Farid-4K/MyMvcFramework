<?php

namespace App\Controllers\Main;

use App\Core\Controller;

/**
 * Class MainController
 * @package App\Controllers\Main
 */
class MainController extends Controller
{
    /**
     * @return string
     */
    public function index()
    {
        //$this->model->writeToTable();
        return $this->view->render('main/index.twig');
    }
}
