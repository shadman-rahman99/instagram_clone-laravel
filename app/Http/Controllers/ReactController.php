<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Post;

use Illuminate\Http\Request;

class ReactController extends Controller
{
    public function store($user_id, $post_id)
    {
      $user = User::findOrfail($user_id);
      $post = Post::findOrfail($post_id);

      return auth()->user()->reacting()->toggle($post);

    }
}
