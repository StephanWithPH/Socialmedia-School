<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'bio', 'avatar', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The posts that belong to the user.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * The comments that belong to the user.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'comments')->withPivot('comment');
    }

    /**
     * The comments that belong to the post.
     */
    public function likes()
    {
        return $this->belongsToMany('App\Post', 'likes');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany('App\User', 'followers', 'leader_id', 'follower_id')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany('App\User', 'followers', 'follower_id', 'leader_id')->withTimestamps();
    }

}
