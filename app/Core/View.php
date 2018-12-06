<?php

namespace App\Core;

use Exception;
use Twig_Environment;
use Twig_Loader_Filesystem;

class View
{
    /**
     * @var Twig_Loader_Filesystem - file system
     */
    public $loader;

    /**
     * @var Twig_Environment - template render engine
     */
    public $engine;

    /**
     * @var string - default path
     */
    public $templates = PATH_ROOT . '/app/assets/templates/';

    public function __construct()
    {
        $this->loader = new Twig_Loader_Filesystem($this->templates);
        $this->engine = new Twig_Environment($this->loader);
    }

    /**
     * Render template
     *
     * @param string $path - relative path from - app/assets/templates
     * @param array $params - template params
     * @return string
     */
    public function render(string $path, array $params = [])
    {
        $template = $this->templates . $path;
        if (file_exists($template)) {
            try {
                echo $this->engine->render($path, $params);
            } catch (Exception $exception) {
                if (Helpers::env('APP_DEBUG')) {
                    exit($exception->getMessage());
                } else {
                    return $this->responseCode(500);
                }
            }
        } else {
            if (Helpers::env('APP_DEBUG')) {
                exit("{$template} not found");
            } else {
                return $this->responseCode(404);
            }
        }
    }

    public function responseCode(int $code)
    {
        $template = "/http/{$code}.twig";
        http_response_code($code);
        if (file_exists($this->templates . $template)) {
            echo $this->render($template);
        } else {
            return "http exit code {$code}";
        }
    }
}
