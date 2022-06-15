@extends('layouts.app')

@section('content')
<div class="container">

  <form  action="/profile/{{$user->id}}/update" enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')
    <div class="row">
      <div class="col-8 offset-2">

        <h1>EDIT PROFILE</h1>

        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-left"
             style="font-size:20px; color:darkblue;">Title</label>


               <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                name="title" value="{{ old('title') ?? $user->profile->title }}"
                 autocomplete="title" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-left"
             style="font-size:20px; color:darkblue;">Description</label>


               <input id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                name="description" value="{{ old('description')?? $user->profile->description }}"
                 autocomplete="description" autofocus>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>


        <div class="form-group row">
            <label for="url" class="col-md-4 col-form-label text-md-left"
             style="font-size:20px; color:darkblue;">URL</label>


               <input id="url" type="text" class="form-control @error('url') is-invalid @enderror"
                name="url" value="{{ old('url')?? $user->profile->url }}"
                 autocomplete="url" autofocus>

                @error('url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>


        <div class="row">
          <label for="image" class="col-md-4 col-form-label"><b>Profile image</b></label>
          <input type="file" name="image" id="image" class="form-control-file">

          @error('image')
                  <strong style="color:red;">{{ $message }}</strong>
          @enderror

        </div>

                <div class="row pt-3">
                  <button class="btn btn-primary"> SAVE PROFILE </button>
                </div>


      </div>
    </div>
  </form>

</div>
@endsection
