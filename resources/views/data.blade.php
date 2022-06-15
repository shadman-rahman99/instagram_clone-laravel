

 @foreach ($post as $show)

  <div class="row">

     <div class="col-6 offset-1">
        <div class="">
          <div class="d-flex align-items-center">
            <div class="pr-4">
              <img src="{{$show->user->Profile->profileImage() }}"
               alt="{{$show->image}}" style="width:70px;" class="rounded-circle">
            </div>
           <a href="/profile/{{$show->user->id}}/index" style=" font-size:20px;">
             {{$show->user->username}}</a>
             <a href="#" style=" font-size:20px;" class="pl-4">Follow</a>
          </div>

          <div class="">
          <p style="font-size:20px;" class="p-4">{{$show->caption}}</p>
          </div>
        </div>
     </div>
  </div>



  <div class="row pb-5 ">
    <div class="col-6 offset-3">
    <a href="/profile/{{$show->user->id}}/index">
      <img src="/storage/{{$show->image}}" alt="{{$show->image}}" class="w-100"></a>
    </div>
  </div>
    <hr>

@endforeach
<!--
<div class=" d-flex justify-content-center pt-2">
         {{ $post->links() }}
</div>
-->
