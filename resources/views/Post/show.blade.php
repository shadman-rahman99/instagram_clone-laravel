@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>

<link href="{{ asset('/css/profileStyle.css') }}" rel="stylesheet">

<?php use App\Models\User; ?>

<div class="container">
  <div class="row ">
  <div class="col-8">
    <img src="/storage/{{$show->image}}" alt="{{$show->image}}" class="w-100" style="height:100%;">
    </div>

     <div class="col-4">
       <div class="d-flex align-items-center">
            <div class="pr-4">
              <img src="{{$show->user->Profile->profileImage() }}"
               alt="{{$show->image}}" style="width:70px;" class="rounded-circle">
            </div>

            <div>
             <a href="/profile/{{$show->user->id}}/index" style=" font-size:20px;">
               {{$show->user->username}}</a>
             <p>{{$created_at}}</p>
            </div>

  @can('update', $show->user->profile)
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

                                <li class="nav-item dropdown">
                                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                      role="button" data-toggle="dropdown"
                                     aria-haspopup="true" aria-expanded="false" v-pre>. . .</a>

                                     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                         <a class="dropdown-item" href="/p/{{$show->id}}/edit">
                                             {{ __('Edit post') }}
                                         </a>

                                         <a class="dropdown-item btn btn-danger"
                                          onclick="return confirm('Are you sure?')"  href="/p/{{$show->id}}/destroy">
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

            <p style="font-size:20px;" class="pt-4 pb-4">{{$show->caption}}</p>

            <div class="mt-5">
              <div class="d-flex align-items-center">

              <Love-React user-id="{{$show->user->id}}"
                post-id="{{$show->id}}" reacts= "{{$reacts}}" react-cnt= "{{$reacter_Count}}" ></Love-React>

               <button class="btn ml-4"> <a href="/p/{{$show->id}}/{{$show->user->id}}/createComment">
                 <img src="/storage/Rand_Img/messageLogo.png"
                 alt="Love react" style="width:35px;"></a>
                  </button>

               <button class="btn ml-2"> <img src="/storage/Rand_Img/uploadLogo.png"
                     alt="Love react" style="width:45px;"> </button>

              </div>
            </div>
               <hr>

            <div class="comment_scrollbar_post_show" data-next-page ="{{$comment->nextPageUrl()}}" >
              <?php $comment_CNT=0 ?>
           <?php foreach ($comment as $comments): ?>

             <?php  $created_at_comment=explode(' ',$comments->updated_at); // $created_at is an array of 2
                $year_str =  substr($created_at_comment[0], 0, 4);
                $month_str = substr($created_at_comment[0], 5, 2);
                $date_str = substr($created_at_comment[0], 8);
                $MONTH = array("Janouary","february","march","april","may","june","july",
              "august","september","october","november","december");
                $month_num = intval($month_str)-1;
                $created_at_comment = "$MONTH[$month_num] ". $date_str ." $year_str";
                // ------- shows the last updated time of a comment ----//

                $reacts_comment = (auth()->user()) ? auth()->user()->Commentreacting->contains($comments->id) : false;
                //---------shows if the auth user reacted to a comment--------//

                $comment_reacter = $comments->Commentreacter()->pluck('users.id');
                $comment_reacter = User::whereIn('id',$comment_reacter)->orderBy('created_at','DESC')->get();
                //------stores all the User class objects who reacted to a comment------//

                $comment_reacter_count = Cache::remember(
                    'count.comment_Reacter.'.$comments->id,
                    now()->addSeconds(30),
                    function() use ($comments) {
                      return $comments->Commentreacter->count();
                    });
                 ?>


               <div class="col-12 offset-1" >
                   <div>
                     <div class="d-flex align-items-center">
                       <div class="pr-4">
                         <img src="{{$comments->user->Profile->profileImage() }}"
                          alt="Image" style="width:50px;" class="rounded-circle">
                       </div>

                       <div>
                         <a href="/profile/{{$comments->user->id}}/index" style=" font-size:20px;">
                           {{$comments->user->username}}</a>
                           <p>{{$created_at_comment}}</p>
                       </div>

                        @can('update', $comments->user->profile)
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

                                                               <a class="dropdown-item" href="/p/{{$comments->id}}/{{$show->id}}/editComment">
                                                                   {{ __('Edit comment') }}
                                                               </a>

                                                               <a class="dropdown-item btn btn-danger"
                                                                onclick="return confirm('Are you sure?')"  href="/p/{{$comments->id}}/{{$show->id}}/destroyComment">
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
                       <p>{{$comments->comment}}</p>
                     </div>

                     <div class="d-flex align-items-center">
                       <Comment-React comment-id="{{$comments->id}}" reacts="{{$reacts_comment}}" ></Comment-React>
                       <a href="/p/{{$show->id}}/{{$comments->id}}/createReply" class="ml-4" style="color:grey;font-size:20px;">Reply</a>
                     </div>
                   </div>



                   <h3 data-toggle="modal" data-target="#myModal_commentLikes">
                     <a href="/p/{{$comments->id}}" style="color:grey;">{{$comment_reacter_count}} Likes</a></h3>
                     @include('Comment/commentReacts')
                </div>
<!--data-toggle="modal" data-target="#myModal_commentLikes"-->
               @include('Reply/show')

               <hr>
            <?php $comment_CNT+=1 ?>
            <?php endforeach; ?>


           <button type="button" id="vmc">Read More...</button>
            </div>
            <br>
            <!-- Trigger the modal with a button -->
          <h3 data-toggle="modal" data-target="#myModal">
            <a href="#" style="color:grey;">{{$reacter_Count}} Likes</h3></a>
          <!-- Modal -->
          <div id="myModal" class="modal fade"role="dialog" style="margin-top:200px;">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="mt-2" style="border-bottom: solid 1px grey;">
                <img src="/storage/Rand_Img/back-button.jpg"
                alt="Go back" class="mb-2" data-dismiss="modal" style="width:45px;">
               <strong style="font-size:20px;" class="ml-1">Likes</strong>
                </div>

                <div class="modal-body">
                  <?php foreach ($post_reacter as $post_reacter): ?>
                  <?php $follows= (auth()->user()) ? auth()->user()->following->contains($post_reacter->profile->id) : false; ?>

                    <div class="d-flex align-items-center mb-3">
                      <div class="pr-4">
                        <img src="{{$post_reacter->Profile->profileImage() }}"
                         alt="Profile Image" style="width:70px;" class="rounded-circle">
                      </div>
                      <div>
                       <a href="/profile/{{$post_reacter->id}}/index" style=" font-size:20px;">
                         {{$post_reacter->username}}</a>
                       </div>
                       <Follow-Button user-id="{{$post_reacter->id}}"
                        class="post-show-Fol-Button"  follows="{{$follows}}"></Follow-Button>
                    </div>

                   <?php endforeach; ?>
                </div>

                <div class="modal-footer">
                </div>
              </div>

            </div>
          </div>

          <h4><a href="/p/{{$show->id}}/{{$show->user->id}}/createComment"
             style="color:grey;">View {{$comment_CNT}} comments</a></h5>
             <div id="test">
               <p>HEYYY</p>
             </div>

     </div>

  </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $("#vmc").click(function(){
      var page = $('.comment_scrollbar_post_show').data('next-page');

      if(page != null)
      {
        $.get(page, function(data){
          alert('get function...');
          $("#test").append(data.comment);
          $(".comment_scrollbar_post_show").data('next-page', data.next_page);
        });
        alert('Not Null');
      //  $(".comment_scrollbar_post_show").append("HEYyyyyyy");
      }else {
        alert('NULL');
      }
    });
  });

</script>
@endsection
