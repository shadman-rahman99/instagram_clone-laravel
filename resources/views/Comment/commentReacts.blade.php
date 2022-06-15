

<div id="myModal_commentLikes" class="modal fade"role="dialog" style="margin-top:200px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="mt-2" style="border-bottom: solid 1px grey;">
      <img src="/storage/Rand_Img/back-button.jpg"
      alt="Go back" class="mb-2" data-dismiss="modal" style="width:45px;">
     <strong style="font-size:20px;" class="ml-1">Likes</strong>
      </div>

      <div class="modal-body">
        <?php foreach ($comment_reacter as $cmnt_reacter): ?>
        <?php $follows = (auth()->user()) ? auth()->user()->following->contains($cmnt_reacter->profile->id) : false; ?>

          <div class="d-flex align-items-center mb-3">
            <div class="pr-4">
              <img src="{{$cmnt_reacter->Profile->profileImage() }}"
               alt="Profile Image" style="width:70px;" class="rounded-circle">
            </div>
            <div>
             <a href="/profile/{{$cmnt_reacter->id}}/index" style=" font-size:20px;">
               {{$cmnt_reacter->username}}</a>
             </div>
             <Follow-Button user-id="{{$cmnt_reacter->id}}"
              class="post-show-Fol-Button"  follows="{{$follows}}"></Follow-Button>
          </div>

          <?php //dd($comment[0],
        //   $comment_reacter = User::whereIn('id', $comment[0]->Commentreacter()->pluck('users.id'))->orderBy('created_at','DESC')->get()); ?>
             <?php endforeach; ?>


         <?php// dd($comment, $comments) ?>
      </div>

      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>
