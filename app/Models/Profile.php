<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable =[
      'title',
      'description',
      'url',
      'image',
    ];

    public function profileImage(){

      //if this ->image is true return it, else return default image address
      $image_path = ($this->image) ? $this->image : 'ProfileImage/profiledefault.jpg';
      return '/storage/'.$image_path;
    }

    public function user(){
      return $this->belongsTo(User::class); // creating O-to-O relationship with User class
    }

    public function follower()
    {
      return $this->belongsToMany(User::class);
    }

}
