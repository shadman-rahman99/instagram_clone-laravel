@extends('layouts.app')

@section('content')
<div class="container">

   <form  action="/p/{{$reply->id}}/{{$comment->id}}/{{$post->id}}/updateReply" enctype="multipart/form-data" method="post">
     @csrf
     @method('PATCH')
     <div class="row">
       <div class="col-9 offset-2">

         <div class="d-flex align-items-center mb-4">

              <div class="pr-4">
                <img src="{{$post->user->Profile->profileImage() }}"
                 alt="{{$post->image}}" style="width:70px;" class="rounded-circle">
              </div>

              <div>
                <a href="/profile/{{$post->user->id}}/index" style=" font-size:20px;">
                  {{$post->user->username}}</a>
                <p>{{$created_at_post}}</p>
              </div>

    @can('update', $post->user->profile)
               <nav class="navbar navbar-expand-md navbar-light bg-white">
                   <div class="container">


                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                           <span class="navbar-toggler-icon"></span>
                       </button>

                       <div class="collapse navbar-collapse" id="navbarSupportedContent">
                           <!-- Left Side Of Navbar -->
                           <ul class="navbar-nav mr-auto">

                           </ul>

                           <!-- Right Side Of Navbar -->
                           <ul class="navbar-nav ml-auto">
                               <!-- Authentication Links -->
                               <div class="d-flex align-items-center">

                               </div>


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


         <img src="/storage/{{$post->image}}" alt="{{$post->image}}" class="w-100">

      <div class="form-group row pt-5">

        <div class="d-flex align-items-center mb-4">

          <img src="{{auth()->User()->Profile->profileImage() }}"
           alt="" style="width:50px;" class="rounded-circle ">

          <a href="/profile/{{auth()->user()->id}}/index" style="font-size:20px;" class="ml-3">
             {{auth()->User()->username}} </a>

        </div>


                <textarea id="reply" type="text" style="width:640px;"
               class="form-control @error('reply') is-invalid @enderror ml-3"
               name="reply" autocomplete="reply" autofocus placeholder="{{ old('reply') ?? $reply->reply }}"></textarea>

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
                   <button class="btn btn-primary"> Save </button>
                 </div>


       </div>
     </div>
   </form>

</div>
@endsection
