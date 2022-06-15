<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\User;

use App\Models\Comment;

use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;

use Intervention\Image\Facades\DB;

use Intervention\Image\Facades\Image;
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>

<?php

class PostController extends Controller
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

   public function index(Request $request)
   {
     // storing userID of all the profiles the logged in user is following
     $user_id = auth()->user()->following()->pluck('profiles.user_id');

     $post = Post::whereIn('user_id', $user_id)->orderBy('created_at','DESC')->Paginate(3);
     //dd($post);

     if($request->ajax()){
       $view  = view('data', compact('post'))->render();
       //dd(json_encode($request));
       return response()->json(['html'=>$view]);

     }
       return view('Post/index', compact('post'));
   }


    public function create(){
      return view('Post/create');
    }

    public function store(){

      $data = request()->validate([
        'caption'=> 'required',
        'image'=> ['required', 'image'],
      ]);

      $image_path = request('image')->store('Img', 'public');
      $image = Image::make(public_path("storage/{$image_path}"))->fit(1200,1200);
      $image->save();

       auth()->User()->posts()->create([
         'caption' => $data['caption'],
         'image' => $image_path,
       ]);

      return redirect('/profile/'.auth()->user()->id.'/index/');
    }


    public function show(Request $request,$posts, $user_id){

      $show = Post::findOrfail($posts);
      $reacts = (auth()->user()) ? auth()->user()->reacting->contains($show->id) : false;


      $reacter_Count =Cache::remember(
        'count.reacter.'.$show->id,
        now()->addSeconds(30),
        function() use ($show) {
          return $show->reacter->count();
        });

      $created_at=explode(' ',$show->updated_at); // $created_at is an array of 2
      $year_str =  substr($created_at[0], 0, 4);
      $month_str = substr($created_at[0], 5, 2);
      $date_str = substr($created_at[0], 8);

      $MONTH = array("Janouary","february","march","april","may","june","july",
    "august","september","october","november","december");

      $month_num = intval($month_str)-1;
      $created_at = "$MONTH[$month_num] ". $date_str ." $year_str";

    $reacter = $show->reacter()->pluck('users.id');  // 'users.id' refers to users table's id column
    $post_reacter = User::whereIn('id',$reacter)->orderBy('created_at','DESC')->get();


     //dd($comment,$comment_array[2]);
     $comment = Comment::whereIn('post_id',[$posts])->orderBy('created_at','DESC')->paginate(4);
     if($request->ajax()){
      return [
         'comment'=>view('Post/data')->with(compact('show', 'reacts', 'comment', 'reacter_Count',
         'created_at', 'post_reacter'))->render(),
         'next_page'=>$comment->nextPageUrl()
       ];
     }
    // dd(view('Post/data')->with(compact('show', 'reacts', 'comment', 'reacter_Count',
     //'created_at', 'post_reacter'))->render(),$comment->nextPageUrl());
      return view('Post/show', compact('show', 'reacts', 'comment', 'reacter_Count',
    'created_at', 'post_reacter'));
    }


    public function edit($post)
    {
      $post = Post::findOrfail($post);
      //$this->authorize('update', $user->profile );
      return view('/Post/edit', ['post'=>$post]);
    }


    public function update($post_id)
    {
      $post = Post::findOrfail($post_id);
      //$this->authorize('update', $user->profile );

      $data = request()->validate([
         'image'=>'image',
         'caption'=>'required',
       ]);

        if(request('image')){
         $image_path = request('image')->store('Img', 'public');
         $image = Image::make(public_path("storage/{$image_path}"))->fit(1200,1200);
         $image->save();

         $image_array = ['image'=>$image_path];
       }
        $post->update(array_merge(
           $data,
           $image_array ?? [],
         ));

       return redirect('/p/'.$post->id.'/'.$post->user->id.'/show');
    }


    public function destroy($post_id)
    {
      $post = Post::findOrfail($post_id);

      $post->delete();
      return redirect('/profile/'.$post->user->id.'/index');
    }

  }
