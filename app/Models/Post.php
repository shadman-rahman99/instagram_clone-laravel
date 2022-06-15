<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
      'image',
      'caption',];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function reacter()
    {
      return $this->belongsToMany(User::class);
    }

}
