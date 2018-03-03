<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title','text','imagePath'];

    public function comments()
    {
    	return $this->hasMany(Comment::class,'post_id','id');
    }
}
