<?php


namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Post;

use App\Models\Comment;

use Illuminate\Http\Request;

class CommentReactController extends Controller
{
    public function store($comment_id)
    {
      $comment = Comment::findOrfail($comment_id);
      return auth()->user()->Commentreacting()->toggle($comment);
    }
}
