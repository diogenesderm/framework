<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //public $table = 'users';

    public $timestamps = false;

    public $fillable = [
        'nome',
        'email',
        'password',
    ];

    public function rulesCreate()
    {
        return [
            'name' => 'min:4|max:255',
            'email' => 'email|unique:User:email',
            'password' => 'min:6',
        ];
    }

    public function rulesUpdate($id)
    {
        return [
            'name' => 'min:4|max:255',
            'email' => 'email|unique:User:email:' . $id,
            'password' => 'min:6|max:6',
        ];
    }
}
