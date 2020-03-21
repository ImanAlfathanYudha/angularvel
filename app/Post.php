<?php

namespace App;

use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = "post";
    protected $fillable = [
        'id_user', 
        'title',
        'body'
    ];

    public function comments() {
        return $this->hasMany('App\Comment');
    }

}