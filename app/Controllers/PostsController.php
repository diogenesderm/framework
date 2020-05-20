<?php

namespace App\Controllers;

use App\Models\Post;
use Core\BaseController;
use Core\Container;
use Core\Redirect;
use Core\Session;

class PostsController extends BaseController
{
    private $post;

    public function __construct()
    {
        parent::__construct();
        $this->post = Container::getModel("Post");
    }
    public function index()
    {
        if (Session::get('message')) {
            $this->view->message = Session::get('message');
            Session::destroy('message');
        }
        $this->setPageTitle('Posts');
        $this->view->posts = $this->post->all();
        $this->renderView('posts/index', 'layout');
    }

    public function show($id)
    {
        $this->view->post = $this->post->find($id);
        $this->setPageTitle($this->view->post->title);
        $this->renderView('posts/show', 'layout');
    }

    public function create()
    {
        $this->setPageTitle('New Post');
        $this->renderView('posts/create', 'layout');
    }

    public function store($id, $request)
    {
        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content,
        ];

        if ($this->post->create($data)) {
            Redirect::route('/posts', ['message' => 'Posts inserido com sucesso']);
        } else {
            Redirect::route('/posts', ['message' => 'Erro ao inserir']);
        }
    }

    public function edit($id)
    {
        $this->view->post = $this->post->find($id);
        $this->setPageTitle("Editar post - " . $this->view->post->title);
        $this->renderView('posts/edit', 'layout');
    }

    public function update($id, $teste, $request)
    {

        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content,
        ];


        if ($this->post->update($data, $id)) {
            Redirect::route('/posts', ['message' => 'Posts atualizado com sucesso']);
        } else {
            Redirect::route('/posts', ['message' => 'Erro ao atualizar']);
        }
    }

    public function delete($id)
    {
        if ($this->post->delete($id)) {
            Redirect::route('/posts', ['message' => 'Posts deletado  com sucesso']);
        } else {
            Redirect::route('/posts', ['message' => 'Erro ao deletar']);
        }
    }
}
