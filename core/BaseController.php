<?php

namespace Core;

abstract class BaseController
{
    protected $view;
    private $viewPath;
    private $layoutPath;
    private $pageTitle = null;

    public function __construct()
    {
        $this->view = new \stdClass;
    }

    protected function renderView($viewPath, $layoutPath = null)
    {
        $this->viewPath = $viewPath;
        $this->layoutPath = $layoutPath;
        if ($layoutPath) {
            return $this->layout();
        } else {
            return $this->content();
        }
    }

    protected function content()
    {
        if (file_exists(__DIR__ . '/../app/Views/' . $this->viewPath . '.phtml')) {
            return require_once __DIR__ . '/../app/Views/' . $this->viewPath . '.phtml';
        } else {
            echo "Error: Layout path not found";
        }
    }

    protected function layout()
    {
        if (file_exists(__DIR__ . '/../app/Views/' . $this->layoutPath . '.phtml')) {
            return require_once __DIR__ . '/../app/Views/' . $this->layoutPath . '.phtml';
        } else {
            echo "Error: View path not found";
        }
    }

    protected function setPageTitle($title)
    {
        $this->pageTitle = $title;
    }

    protected function getPageTitle($separator = null)
    {
        if ($separator) {
            echo $this->pageTitle . " " . $separator . " ";
        } else {
            echo $this->pageTitle;
        }
    }
}
