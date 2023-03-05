@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="text-center">{{$album->name}}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="gallery">
              @foreach ($images as  $index=>$image  )
              <div class="gallery-item">
                <img src="{{$image->image}}">
              </div>
              @endforeach
              </div>
             
        </div>
    </div>
</div>
@endsection
