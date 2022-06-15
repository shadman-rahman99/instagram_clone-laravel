<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\User;

use App\Models\Comment;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Cache;

use Intervention\Image\Facades\DB;

class CommentController extends Controller
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

   public function create($post_id, $user_id)
   {
     $post = Post::findOrfail($post_id);
     $user = User::findOrfail($user_id);

     $comment = Comment::whereIn('post_id',[$post_id])->orderBy('created_at','DESC')->simplePaginate(3);

     return view('Comment/create', compact('post', 'user', 'comment'));
   }

   public function store($post_id, $user_id)
   {
     $post = Post::findOrfail($post_id);
     $user = User::findOrfail($user_id);

    $data = request()->validate([
      'comment'=> 'required',
      'post_id'=> 'required',
    ]);

     //dd($data);
     auth()->User()->comments()->create([
       'comment' => $data['comment'],
       'post_id' => $data['post_id'],
     ]);

      return redirect('/p/'.$post_id.'/'.$post->user->id.'/show');

   }

   public function edit($comment_id, $post_id)
   {
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

     return view('/Comment/edit',compact('comment', 'post','created_at_post'));
   }

   public function update( $comment_id ,$post_id)
   {
     $comment = Comment::findOrfail($comment_id);
     $post = Post::findOrfail($post_id);
     //$this->authorize('update', $user->profile );

     $data = request()->validate([
       'comment'=> 'required',
       'post_id'=> 'required',
     ]);

    //dd($data, $comment);
       $comment->update(
         $data
       );

        return redirect('/p/'.$post_id.'/'.$post->user->id.'/show');
   }

   public function destroy($comment_id, $post_id)
   {
     $comment = Comment::findOrfail($comment_id);
     $post = Post::findOrfail($post_id);

     $comment->delete();
    return redirect('/p/'.$post->id.'/'.$post->user->id.'/show');
   }


   public function showReacts($comment_id)
   {
     $comment = Comment::findOrfail($comment_id);
     $comment_reacter = $comment->Commentreacter()->pluck('users.id');
     $comment_reacter = User::whereIn('id',$comment_reacter)->orderBy('created_at','DESC')->get();
     //dd($comment_reacter);
     return view('/Comment/commentReacts',compact('comment_reacter'));

   }

}
