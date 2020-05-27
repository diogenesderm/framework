<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'users';

    public $timestamps = false;

    public $fillable = [
        'nome',
        'email',
        'password',
    ];

    public function rules()
    {
        return array();
    }

}
