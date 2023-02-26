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
                      
                        <a class="gallery__item" href="google">
                            <h2>Gallery Name</h2>
                        </a>
                     
                        <div class="gallery__item">
                            <h2>Gallery Name</h2>
                        </div>
                        <div class="gallery__item">
                            <h2>Gallery Name</h2>
                        </div>
                        <div class="gallery__item">
                            <h2>Gallery Name</h2>
                        </div>
                        <div class="gallery__item">
                            <h2>Gallery Name</h2>
                        </div>
                        <div class="gallery__item">
                            <h2>Gallery Name</h2>
                        </div>
                        <div class="gallery__item">
                            <h2>Gallery Name</h2>
                        </div>
                        <div class="gallery__item">
                            <h2>Gallery Name</h2>
                        </div>
                        <div class="gallery__item">
                            <h2>Gallery Name</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
