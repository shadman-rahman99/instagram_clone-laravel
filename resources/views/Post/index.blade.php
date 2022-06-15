@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>


<div class="container">

  <div class="col-md-12" id="post-data">
    @include('data')
  </div>

  <div class="ajax-load text-center" style ="display:none">
    <p><img src="/storage/Rand_Img/insta-dataloader.gif">Loading More Post... </p>
  </div>

</div>

<script>

$(document).ready(function(){

  function loadMoreData(page){
     $.ajax({
       url:'http://freeCodeGram.com/?page='+ page,
       type:'get',
       beforeSend:function(){
         $(".ajax-load").show();
       }
     }).done(function(data){
       if(data.html == " "){
         $('.ajax-load').html("No more data");
       }
       $('.ajax-load').hide();
       $("#post-data").append(data.html);
     }).fail(function(jqXHR, ajaxOptions,textStatus, thrownError){
       //alert('Server not responding!');
       console.log("textStatus: "+textStatus+"\n ajaxOPtions: "+ajaxOptions+"\n jqXHR: "+jqXHR);
     });
   }


$(window).scroll(function(){
  var page = 1;
if($(window).scrollTop() + $(window).height() >= $(document).height() ){
 page++;
 loadMoreData(page);
}
  });


});

</script>

@endsection
