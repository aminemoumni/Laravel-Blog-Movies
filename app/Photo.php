<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $storage = '/storage/';
    protected $fillable = [
        'file'
    ];

    public function getFileAttribute($photo){
        return $this->storage . $photo;
    }
    public function user(){
        return $this->hasOne('App\User');
    }
    public function post(){
        return $this->hasOne('App\Post');
    }
    public function comment(){
        return $this->hasOne('App\Comment');
    }
    public function commentReply(){
        return $this->hasOne('App\CommentReply');
    }
}
