<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    /**
     * The post that belong to the comment.
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    /**
     * The user that belong to the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
