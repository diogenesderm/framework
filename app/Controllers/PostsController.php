<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class PostsController extends BaseController
{
    public function index()
    {
        $this->setPageTitle('Posts');
        $model = Container::getModel("Post");
        $this->view->posts =  $model->all();
        $this->renderView('Posts/index', 'layout');
    }

    public function show($id, $request)
    {
        echo 'shwo' . $id . '<br>';
        echo $request->get->nome . '<br>';
        echo $request->get->sexo . '<br>';
    }
}
