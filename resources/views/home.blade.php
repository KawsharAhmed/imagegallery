@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="gallery_box">
        
                        @foreach ($gallries as $gallery )
                        <a class="gallery__item" href="google" style="background-image: url({{$gallery->thumbnail}})">
                            <h2>{{$gallery->name}}</h2>
                        </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
