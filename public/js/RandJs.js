// USE THIS FILE FOR RANDOM JAVASCRIPT CODE

$(document).ready(function(){
  $("#vmc").click(function(){
    $("#RandomDisplay").load("PostController.php #test",
    {}, function(){
       alert("loaded!");
    });
  });
});
