<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Validator;
use App\Models\User;
use Core\Redirect;

class UserController extends BaseController
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }
    public function create()
    {
        $this->setPageTitle('New User');
        return $this->renderView('user/create', 'layout');
    }

    public function store($request)
    {
        $data = [
            'name' => $request->post->name,
            'email' => $request->post->email,
            'password' => $request->post->password,
        ];

        if (Validator::make($data, $this->user->rules())) {
            return Redirect::route('/user/create');
        }
        $data['password'] = password_hash($request->post->password, PASSWORD_BCRYPT);

        try {
            $this->user->create($data);

            return Redirect::route("/posts", [
                'message' => 'User criado com successo',
            ]);
        } catch (\Exception $e) {
            return Redirect::route("/", [
                'message' => $e->getMessage(),
            ]);
        }
    }
}
