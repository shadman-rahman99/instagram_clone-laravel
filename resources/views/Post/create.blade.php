@extends('layouts.app')

@section('content')
<div class="container">

   <form  action="/p" enctype="multipart/form-data" method="post">
     @csrf
     <div class="row">
       <div class="col-8 offset-2">
         <h1>ADD NEW POST HERE..</h1>
         <div class="form-group row">
             <label for="caption" class="col-md-4 col-form-label text-md-right"
              style="font-size:20px; color:darkblue;">Post Caption</label>


                 <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror"
                 name="caption" value="{{ old('caption') }}"
                  autocomplete="caption" autofocus>

                 @error('caption')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                 @enderror
         </div>

                 <div class="row">
                   <label for="image" class="col-md-4 col-form-label"><b>Post image</b></label>
                   <input type="file" name="image" id="image" class="form-control-file">

                   @error('image')
                           <strong style="color:red;">{{ $message }}</strong>
                   @enderror

                 </div>

                 <div class="row pt-3">
                   <button class="btn btn-primary"> ADD NEW POST </button>
                 </div>


       </div>
     </div>
   </form>
   
</div>
@endsection
