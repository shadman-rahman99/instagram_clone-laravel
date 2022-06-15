<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     protected static function boot(){
       parent::boot();
       static::created(function ($user) {
         $user->profile()->create([
           'title'=>$user->username,
         ]);

        Mail::to($user->email)->send(new NewUserWelcomeMail());

       });
     }

    public function profile(){
      return $this->hasOne(Profile::class);
    }

    public function posts(){
      return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function postsReacting(){
      return $this->hasOne(Post::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
    }

    public function replies()
    {
      return $this->hasMany(Reply::class)->orderBy('created_at', 'DESC');
    }


    public function following()
    {
      return $this->belongsToMany(Profile::class);
    }

    public function reacting()
    {
      return $this->belongsToMany(Post::class);
    }

    public function Commentreacting()
    {
      return $this->belongsToMany(Comment::class);
    }

}
