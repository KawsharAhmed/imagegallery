@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">Album</div>
        <div class="row p-3">
            <div class="col-md-8">
                <h3>Album List</h3>
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
                        @foreach ($albums as  $index=>$album  )
                        <tr>
                            <th scope="row">{{++$index}}</th>
                            <td>{{$album->name}}</td>
                            <td>
                                <img src="{{asset($album->thumbnail)}}" alt="gallery image" style="width:60px"/>
                            </td>
                            <td>

                                <div class="d-flex align-items-center  ">
                                <a href="{{url('edit-album',$album->id)}}" class="btn btn-primary me-1">Edit</a>
                               
                                <form id="delete-gallery-{{ $album->id }}" action="{{url('delete-album',$album->id)}}" method="post">
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
                
                @isset($singleAlbum)
                <form action="{{route('update.album',$singleAlbum->id)}}" method="post" class="d-flex ">
                    @else
                    <form action="{{route('store.album')}}" method="post" class="d-flex ">
                @endisset
                @csrf
            
                    <input name="name"  value="{{isset($singleAlbum->name)?$singleAlbum->name:''}}" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Album Name">
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>

                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
