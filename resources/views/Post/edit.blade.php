@extends('layouts.app')

@section('content')
<div class="container">

  <form  action="/p/{{$post->id}}/update" enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')
    <div class="row">
      <div class="col-8 offset-2">
        <h1>Edit your post</h1>
        <div class="form-group row">
            <label for="caption" class="col-md-4 col-form-label text-md-right"
             style="font-size:20px; color:darkblue;">Post Caption</label>


                <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror"
                name="caption" value="{{ old('caption') ?? $post->caption }}"
                 autocomplete="caption" autofocus>

                @error('caption')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

                <div class="row">
                  <label for="image" class="col-md-4 col-form-label"><b>Post image</b></label>
                  <input id="image" type="file" class="form-control-file"
                  name="image" value="{{ $post->image }}">
                  @error('image')
                          <strong style="color:red;">{{ $message }}</strong>
                  @enderror

                </div>

                <div class="col-2 pt-5">
                  <img src="/storage/{{$post->image}}" alt="{{$post->image}}" style="width:400px;">
                </div>

                <div class="row pt-3">
                  <button class="btn btn-primary"> UPDATE POST </button>
                </div>


      </div>
    </div>
  </form>

</div>
@endsection
