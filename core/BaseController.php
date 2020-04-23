<?php

namespace Core;

abstract class BaseController
{
    protected $view;
    private $viewPath;

    public function __construct()
    {
        $this->view = new \stdClass;
    }

    protected function renderView($viewPath)
    {
        $this->viewPath = $viewPath;
        $this->content();
    }

    protected function content()
    {
        if (file_exists(__DIR__ . '/../app/Views/' . $this->viewPath . '.phtml')) {
            require_once __DIR__ . '/../app/Views/' . $this->viewPath . '.phtml';
        } else {
            echo "Error: View path not found";
        }
    }
}
