@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">Image</div>
    <div class="row p-3">
        <div class="col-md-8">
            <h3>Image List</h3>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Album Name</th>
                    <th scope="col">image</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($images as  $index=>$image  )
                    <tr>
                        <td scope="row">{{++$index}}</td>
                        <td >{{$image->title}}</td>
                        <td >{{$image->name}}</td>
                        <td > <img src="{{asset($image->image)}}" alt="gallery image" style="width:60px"/></td>
                        <td>
                            <div class="d-flex align-items-center  ">
                                <a href="{{url('edit-image-upload',$image->id)}}" class="btn btn-primary me-1">Edit</a>
                               
                                <form id="delete-gallery-{{ $image->id }}" action="{{route('delete.image',$image->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" class="btn btn-danger show_confirm" >Delete</a>
                                </form>
                                </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="col-md-4 ">
        

            <h3>Create Album</h3>
            
                <form action="{{route('store.image')}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <input name="title"  value="{{isset($singleAlbum->name)?$singleAlbum->name:''}}" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Album Name">
            </div>
            <div class="mb-3 mt-3">
                <select class="form-control" name="album_id">
                    <option>Select Any One</option>
                    @foreach ($albums as  $album)
                    <option value="{{$album->id}}">{{$album->name}} </option>
                    @endforeach
                    
                </select>
            </div>
            <div class="mb-3 mt-3">
                <input  type="file" name="files[]"   class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Album Name" multiple>
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>

            </div>
        </div>
        </div>
    </div>
</div>
@endsection
