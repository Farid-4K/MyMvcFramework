<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Factory\JournalFactory;
use Exception;

/**
 * Class Router
 *
 * @package App\Core
 */
class Router
{
    private $routes = [];
    private $params;
    private $journal;

    public function __construct()
    {
        $routes = FileSystem::config('routes');
        $this->journal = JournalFactory::create(FileSystem::config('journal'));
        foreach ($routes as $url => $options) {
            $this->add($url, $options);
        }
    }

    public function add($route, $params)
    {
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    /**
     * @return bool
     */
    public function match(): bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int)$match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function processing()
    {
        try {
            $this->call();
        } catch (Exception $exception) {
            $this->journal->exception($exception);
            switch ($exception->getCode()) {
                case 1:
                    http_response_code(404);
                    break;
                case 2:
                case 3:
                    if (Helpers::env('APP_DEBUG')) {
                        exit($exception->getMessage());
                    } else {
                        http_response_code(500);
                    }
            }
        }
    }

    /**
     * @throws Exception
     */
    private function call()
    {
        if (!$this->match()) {
            throw new Exception(__METHOD__ . " - Route not found", 1);
        }
        $namespace = FileSystem::controllers(true);
        if (array_key_exists('namespace', $this->params)) {
            $namespace .= '\\' . ucfirst($this->params['namespace']);
        }
        $controller = '\\' . ucfirst($this->params['controller']);
        $controllerPath = $namespace . $controller . "Controller";
        if (!class_exists($controllerPath)) {
            throw new Exception(__METHOD__ . " - Class not found", 2);
        }
        $action = $this->params['action'];
        if (!method_exists($controllerPath, $action)) {
            throw new Exception(__METHOD__ . " - Method not found", 3);
        }
        $controller = new $controllerPath($this->params);
        $controller->$action();
    }
}
