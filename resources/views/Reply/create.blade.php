@extends('layouts.app')

@section('content')
<link href="{{ asset('/css/profileStyle.css') }}" rel="stylesheet">
<div class="container">
     <div class="row">
       <div class="col-9 offset-2">

         <div class="d-flex align-items-center mb-4">

              <div class="pr-4">
                <img src="{{$post->user->Profile->profileImage() }}"
                 alt="{{$post->image}}" style="width:70px;" class="rounded-circle">
              </div>
             <a href="/profile/{{$post->user->id}}/index" style=" font-size:20px;">
               {{$post->user->username}}</a>

    @can('update', $post->user->profile)
               <nav class="navbar navbar-expand-md navbar-light bg-white">
                   <div class="container">


                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                           <span class="navbar-toggler-icon"></span>
                       </button>

                       <div class="collapse navbar-collapse" id="navbarSupportedContent">

                           <ul class="navbar-nav ml-auto">

                                  <li class="nav-item dropdown">
                                       <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                        role="button" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false" v-pre>. . .</a>

                                       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                           <a class="dropdown-item" href="/p/{{$post->id}}/edit">
                                               {{ __('Edit post') }}
                                           </a>

                                           <a class="dropdown-item btn btn-danger"
                                            onclick="return confirm('Are you sure?')"  href="/p/{{$post->id}}/destroy">
                                           {{ __('Delete post') }}
                                         </a>


                                       </div>
                                   </li>
                           </ul>
                       </div>
                   </div>
               </nav>
               @endcan

            </div>

          <p style="font-size:20px;" class="pt-2 pb-4">{{$post->caption}}</p>
         <img src="/storage/{{$post->image}}" alt="{{$post->image}}" class="w-100">

         <div class="comment_scrollbar_comment_create mt-4">

          <?php  $created_at_comment=explode(' ',$comment->updated_at); // $created_at is an array of 2
             $year_str =  substr($created_at_comment[0], 0, 4);
             $month_str = substr($created_at_comment[0], 5, 2);
             $date_str = substr($created_at_comment[0], 8);
             $MONTH = array("Janouary","february","march","april","may","june","july",
           "august","september","october","november","december");
             $month_num = intval($month_str)-1;
             $created_at_comment = "$MONTH[$month_num] ". $date_str ." $year_str"; ?>


                  <div class="d-flex align-items-center">
                    <div class="pr-4">
                      <img src="{{$comment->user->Profile->profileImage() }}"
                       alt="Image" style="width:50px;" class="rounded-circle">
                    </div>
                   <a href="/profile/{{$comment->user->id}}/index" style=" font-size:20px;">
                     {{$comment->user->username}}</a>

                     @can('update', $comment->user->profile)
                                <nav class="navbar navbar-expand-md navbar-light bg-white">
                                    <div class="container">


                                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>

                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <!-- Left Side Of Navbar -->


                                            <!-- Right Side Of Navbar -->
                                            <ul class="navbar-nav ml-auto">

                                                   <li class="nav-item dropdown">
                                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                                         role="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false" v-pre>. . .</a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                                            <a class="dropdown-item" href="/p/{{$comment->id}}/{{$post->id}}/edit">
                                                                {{ __('Edit comment') }}
                                                            </a>

                                                            <a class="dropdown-item btn btn-danger"
                                                             onclick="return confirm('Are you sure?')"  href="/p/{{$comment->id}}/{{$post->id}}/destroy">
                                                            {{ __('Delete comment') }}
                                                          </a>


                                                        </div>
                                                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                                @endcan
                          </div>

                  <div class="m-3" style="font-size:20px;">
                    <p>{{$comment->comment}}</p>
                  </div>
                  <p>{{$created_at_comment}}</p>
            <hr>
         </div>

         <form  action="/p/{{$post->id}}/{{$comment->id}}/storeReply" enctype="multipart/form-data" method="post">
           @csrf
      <div class="form-group row">

        <div class="d-flex align-items-center mb-4">

          <img src="{{auth()->User()->Profile->profileImage() }}"
           alt="{{$post->image}}" style="width:50px;" class="rounded-circle ">

          <a href="/profile/{{auth()->user()->id}}/index" style="font-size:20px;" class="ml-3">
             {{auth()->User()->username}} </a>
         </div>


        <textarea id="reply" type="text" style="width:640px;"
       class="form-control @error('reply') is-invalid @enderror ml-3"
       name="reply" autocomplete="reply" autofocus placeholder="Reply to {{$comment->user->username}}"></textarea>

       <input type="hidden" class="form-control @error('comment_id') is-invalid @enderror ml-3"
       name="comment_id" value="{{$comment->id}}">

       <input type="hidden" class="form-control @error('post_id') is-invalid @enderror ml-3"
        name="post_id" value="{{$post->id}}">


       @error('reply')
           <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
           </span>
       @enderror

       @error('comment_id')
       <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
       </span>
       @enderror

       @error('post_id')
           <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
           </span>
       @enderror


      </div>
      <hr>

    <div class="row pt-3">
       <button class="btn btn-primary"> Reply </button>
     </div>


       </div>
     </div>
   </form>

</div>
@endsection
