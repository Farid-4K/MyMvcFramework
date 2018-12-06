<?php

namespace App\Core;

abstract class Controller
{
    protected $view;

    protected $model;

    /**
     * Controller constructor.
     * @param array $route
     */
    public function __construct(array $route)
    {
        $this->view = new View();
        $this->model = $this->loadModel($route['controller'], $route['action']);
    }

    /**
     * Загрузка модели
     * @param string $controller
     * @param string $action
     * @return mixed
     */
    protected function loadModel(string $controller, string $action)
    {
        $controller = ucfirst($controller);
        $action = ucfirst($action);
        $model_class = "App\Models\{$controller}\{$action}";
        if (class_exists($model_class)) {
            return new $model_class;
        }
    }
}
