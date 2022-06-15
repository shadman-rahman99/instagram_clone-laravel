<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\User;

use App\Models\Comment;

use App\Models\Reply;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Cache;

use Intervention\Image\Facades\DB;


class ReplyController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

   public function create($post_id,$comment_id)
   {
     $post = Post::findOrfail($post_id);
     $comment = Comment::findOrfail($comment_id);

     //dd($post,$comment);

     return view('Reply/create', compact('post','comment'));
   }


   public function store($post_id, $comment_id)
   {

    $post = Post::findOrfail($post_id);

    $data = request()->validate([
      'reply'=> 'required',
      'post_id'=> 'required',
      'comment_id'=> 'required',
    ]);

       auth()->User()->replies()->create([
       'reply' => $data['reply'],
       'post_id' => $data['post_id'],
       'comment_id' => $data['comment_id'],
     ]);

      return redirect('/p/'.$post_id.'/'.$post->user->id.'/show');

   }

   public function edit($reply_id,$comment_id, $post_id)
   {
     $reply = Reply::findOrfail($reply_id);
     $comment = Comment::findOrfail($comment_id);
     $post = Post::findOrfail($post_id);

     $created_at=explode(' ',$post->updated_at); // $created_at is an array of 2
     $year_str =  substr($created_at[0], 0, 4);
     $month_str = substr($created_at[0], 5, 2);
     $date_str = substr($created_at[0], 8);

     $MONTH = array("Janouary","february","march","april","may","june","july",
   "august","september","october","november","december");

     $month_num = intval($month_str)-1;
     $created_at_post = "$MONTH[$month_num] ". $date_str ." $year_str";

     return view('Reply/edit',compact('reply','comment', 'post','created_at_post'));
   }

   public function update($reply_id,$comment_id ,$post_id)
   {
     $reply = Reply::findOrfail($reply_id);
     $comment = Comment::findOrfail($comment_id);
     $post = Post::findOrfail($post_id);
     //$this->authorize('update', $user->profile );

     $data = request()->validate([
       'reply'=> 'required',
       'post_id'=> 'required',
       'comment_id'=> 'required',
     ]);

    //dd($data, $comment);
       $reply->update(
         $data
       );

        return redirect('/p/'.$post_id.'/'.$post->user->id.'/show');
   }

   public function destroy($reply_id,$comment_id, $post_id)
   {
     $reply = Reply::findOrfail($reply_id);
     $comment = Comment::findOrfail($comment_id);
     $post = Post::findOrfail($post_id);

     $reply->delete();
    return redirect('/p/'.$post->id.'/'.$post->user->id.'/show');
   }


}
