<?php

namespace App\Controllers;

use Core\BaseController;

class HomeController extends BaseController
{


    public function index()
    {

        $this->view->nome = "teste de nome";
        $this->renderView('home/index');
    }
}
