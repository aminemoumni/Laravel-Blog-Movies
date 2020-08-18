<?php

namespace App;

use App\Post;
use App\User;
use App\Photo;
use App\CommentReply;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'post_id',
        'author',
        'email' ,
        'body',
        'is_active',
    ];
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function replies(){
        return $this->hasMany(CommentReply::class);
    }
    public function photo(){
        return $this->belongsTo('App\Photo');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
