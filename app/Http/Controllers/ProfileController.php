<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Profile;

use Illuminate\Support\Facades\Cache;

use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

  public function index($user)    // $user is the arguement recieved from the
                                  //restful routing, and is used here to fetch its value
                                  // in the user table fron User class
  {
    $user = User::findOrfail($user);

    // The contains() function returns if the value in the arguement exist or not and returns
    // a boolean value
    // First of all it checks if the user is authorized; if not return false
    // else, return the profile's Id the authorized user's followng() contains
    // (which can also be true or false) .
    $follows= (auth()->user()) ? auth()->user()->following->contains($user->profile->id) : false;

    $postCount = Cache::remember(
      'count.post.'.$user->id,
      now()->addSeconds(30),
      function() use ($user) {
        return $user->posts->count();
      });


    $followerCount =Cache::remember(
      'count.follower.'.$user->id,
      now()->addSeconds(30),
      function() use ($user) {
        return $user->profile->follower->count();
      });

    $followingCount =Cache::remember(
      'count.following.'.$user->id,
      now()->addSeconds(30),
      function() use ($user) {
        return $user->following->count();
      });


    return view('Profile/index', compact('user', 'follows','postCount',
    'followerCount','followingCount'));
  }


  public function edit($user)
  {
     $user = User::findOrfail($user);
     $this->authorize('update', $user->profile );
     return view('/Profile/edit', ['user'=>$user]);
  }

  public function update($user)
  {
    $user = User::findOrfail($user);

   // Makes sure only authorized user is updating profile info
    $this->authorize('update', $user->profile );

     $data = request()->validate([
       'title'=>'required',
       'description'=>'required',
       'url'=>'url',
       'image'=>'image',
     ]);

      // request('image') checks if the request has an image or the user wants to upload an image
      // if request has image, we create an appropirate image object with proper image path and save it.
      // then we create an array ['image'=>$image_path] which we will merge with 'image', the original
      // image object in $data array. If request has no image $image_path is Null.
      if(request('image')){
       $image_path = request('image')->store('ProfileImage', 'public');
       $image = Image::make(public_path("storage/{$image_path}"))->fit(1000,1000);// actualimage path
       $image->save();

       $image_array = ['image'=>$image_path];
     }

    // Makes sure only authorized user is updating profile info
    auth()->user()->profile->update(array_merge(
      $data,

      // if $image_array is true it will merge with $data, else $data will merge with empty array
      // specified by the " ?? " (	Null coalescing).
      $image_array ?? [],
    ));
     return redirect('/profile/'.auth()->user()->id.'/index/');
  }


}
?>
