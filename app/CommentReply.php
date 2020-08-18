<?php

namespace App;

use App\Comment;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    
    protected $fillable = [
        'comment_id',
        'author',
        'email' ,
        'photo_id',
        'body',
        'is_active',
    ];

    public function comment(){
        return $this->belongsTo(Comment::class);
    }
    public function photo(){
        return $this->belongsTo('App\Photo');
    }
}
