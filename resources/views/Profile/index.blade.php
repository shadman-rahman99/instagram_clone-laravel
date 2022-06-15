@extends('layouts.app')

@section('content')

<!-- Link to CSS file in the asset folder -->
<link href="{{ asset('/css/profileStyle.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
    <div class="col-3 pl-5">
     <img src="{{$user->profile->profileImage()}}" alt=""
     class="rounded-circle profileImage" >
      </div>

<div class="col-9 pl-5">
      <div class="d-flex justify-content-between align-items-baseline">

    <div class="d-flex align-items-center mb-3">
      <h1>{{$user->username}}</h1>

      <Follow-Button user-id="{{$user->id}}" follows="{{$follows}}" ></Follow-Button>
    </div>

        @can('update', $user->profile)
          <a href="/p/create"
            style="font-size:20px;">Add new post</a>
        @endcan

      </div>

      <div class="d-flex">
      <div class="pr-4"> <h5> <strong> {{$postCount}} </strong>posts </div> </h4>
      <div class="pr-4"> <h5><strong> {{$followerCount}} </strong>followers </div></h5>
      <div class="pr-4"> <h5><strong> {{$followingCount}} </strong>following </div></h5>
      </div>

      @can('update', $user->profile)
        <h5><a href="/profile/{{$user->id}}/edit"> Edit profile</a> </h5>
      @endcan

      <div>
        <div class="pt-2 font-weight-bold"> <h5>{{$user->Profile->title}}</h5> </div>
        <div> <h5>{{$user->Profile->description}}</h5></div>
        <div><h5><a href="#"> {{$user->Profile->url}} </a></h5></div>
      </div>
</div>

        <div class="row pt-5  align-items-baseline">
     <?php foreach ($user->posts as $posts): ?>
         <div class="col-4 p-2">
           <a href="/p/{{ $posts->id }}/{{$posts->user->id}}/show"> <img src="/storage/{{$posts->image}}" alt="image" class="w-100"></a>
          </div>
       <?php endforeach; ?>
       </div>

    </div>
</div>
@endsection
