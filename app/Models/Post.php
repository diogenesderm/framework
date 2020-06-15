<?php

namespace App\Models;

use Core\BaseModelEloquent;
use Core\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Post extends BaseModelEloquent
{
    public $table = 'posts';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'content'
    ];

    public function rules()
    {
        return  [
            'title' => 'required',
            'content' => 'max:30'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
