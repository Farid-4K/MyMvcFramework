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
        $this->model = $this->loadModel($route['controller'], $route['namespace'] ?: "");
    }

    /**
     * Загрузка модели
     * @param string $controller
     * @param string $namespace
     * @return mixed
     */
    private function loadModel(string $controller, string $namespace = null)
    {
        $controller = ucfirst($controller);
        $namespace = ucfirst($namespace);

        $model_class = FileSystem::models(true);
        $model_class .= $namespace
            ? "\\{$namespace}\\{$controller}"
            : "\\{$controller}";
        if (class_exists($model_class)) {
            return new $model_class;
        }
    }
}
