<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    /**
     * The roles that belong to the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The comments that belong to the post.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * The comments that belong to the post.
     */
    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes');
    }
}
