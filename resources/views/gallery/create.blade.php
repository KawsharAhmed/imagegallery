@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create Gallery</div>

              <form action="{{route('create-image')}}" method="post">
@csrf
                <input name="image"  >
                <button type="submit" class="btn btn-primary">submit</button>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection
