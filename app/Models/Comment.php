<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Comment extends Model
{
    protected $table = 'comments';
    public function post()
    {
    	return $this->hasOne(Post::class, 'id', 'post_id');
    }
}
