<?php use App\Models\Reply;

$reply = Reply::whereIn('comment_id',[$comments->id])->orderBy('created_at','DESC')->get();

foreach ($reply as $reply):


  $created_at_reply=explode(' ',$reply->updated_at); // $created_at is an array of 2
    $year_str =  substr($created_at_reply[0], 0, 4);
    $month_str = substr($created_at_reply[0], 5, 2);
    $date_str = substr($created_at_reply[0], 8);
    $MONTH = array("Janouary","february","march","april","may","june","july",
  "august","september","october","november","december");
    $month_num = intval($month_str)-1;
    $created_at_reply = "$MONTH[$month_num] ". $date_str ." $year_str";


?>

<div class="col-12 offset-1 mt-5 ml-5" >
      <div class="d-flex align-items-center ml-5">
        <div class="pr-4">
          <img src="{{$reply->user->Profile->profileImage() }}"
           alt="Image" style="width:50px;" class="rounded-circle">
        </div>

        <div>
          <a href="/profile/{{$reply->user->id}}/index" style=" font-size:20px;">
            {{$reply->user->username}}</a>
            <p>{{$created_at_reply}}</p>
        </div>

         @can('update', $reply->user->profile)
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

                                                <a class="dropdown-item" href="/p/{{$reply->id}}/{{$comments->id}}/{{$show->id}}/editReply">
                                                    {{ __('Edit reply') }}
                                                </a>

                                                <a class="dropdown-item btn btn-danger"
                                                 onclick="return confirm('Are you sure?')"  href="/p/{{$reply->id}}/{{$comments->id}}/{{$show->id}}/destroyReply">
                                                {{ __('Delete reply') }}
                                              </a>


                                            </div>
                                        </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    @endcan
                  </div>

      <div class="mt-3 ml-5" style="font-size:20px;">
        <p class="ml-4">{{$reply->reply}}</p>
      </div>

 </div>
<hr>
<?php  endforeach; ?>
