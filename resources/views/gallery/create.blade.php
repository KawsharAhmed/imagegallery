@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">Create Gallery</div>
        <div class="row p-3">
            <div class="col-md-8">
                <h3>Gallery List</h3>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">thumbnail</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($gallries as  $index=>$gallery  )
                        <tr>
                            <th scope="row">{{++$index}}</th>
                            <td>{{$gallery->name}}</td>
                            <td>
                                <img src="{{$gallery->thumbnail}}" alt="gallery image" style="width:60px"/>
                            </td>
                            <td>

                                <a href="{{url('edit-gallery',$gallery->id)}}" class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="col-md-4 ">
                <h3>Create Gallery</h3>
                
                    @isset($singleGallery)
                    <form action="{{route('update.gallery',$singleGallery->id)}}" method="post" class="d-flex ">
                        @else
                        <form action="{{route('store.gallery')}}" method="post" class="d-flex ">
                    @endisset
                    @csrf
                    <div>
                        <input name="name"  value="{{isset($singleGallery->name)?$singleGallery->name:''}}" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Gallery Name">
                        @error('name')
                        {{-- <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span> --}}
                   
                @enderror
            </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>

        </div>
            </div>
        </div>
    </div>
</div>
@endsection
