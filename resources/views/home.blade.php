@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-3 pl-5">
        <img src="Img/instaLogo.png" alt="" style="height:200px;" >
      </div>

<div class="col-9 pl-3">
      <div class="d-flex justify-content-between align-items-baseline">
        <h1>Freecodecamp</h1>
        <a href="p/create/" style="font-size:20px;">Add new post</a>
      </div>

<?php //{{$user->username}}
       //{{$user->Profile->title}} {{$user->Profile->description}}
       // {{$user->Profile->description}}

 ?>
      <div class="d-flex">
      <div class="pr-4"> <b>153</b> posts </div>
      <div class="pr-4"> <strong> 23k </strong>followers </div>
      <div class="pr-4"> <strong> 153 </strong>posts </div>
      </div>

      <div>
        <div class="pt-4 font-weight-bold">Freecodecamp</div>
        <div>Freecodecamp</div>
        <div> <a href="#">Freecodecamp</a> </div>
      </div>
</div>

     <div class="row pt-5">
       <div class="col-4"><img src="Img/image1.jpg" alt=""> </div>
       <div class="col-4 pl-3.5 "><img src="Img/image2.jpg" alt="" style="width:270px;"> </div>
       <div class="col-4"><img src="Img/image3.jpg" alt="" style="width:300px; height:180px;"> </div>
     </div>

    </div>
</div>
@endsection
