<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DalleApiService;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreGalleryRequest;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class AlbumController extends Controller
{
    //
    
    protected $dalleApiService;
    protected $generateSingleImage;

    public function __construct(DalleApiService $dalleApiService)
    {
        $this->dalleApiService = $dalleApiService;
    }

   

    public function create(){
        $user_id =  Auth::user()->id;
        $albums = Album::where('user_id',$user_id)->get();
        return view('album.create',compact('albums'));
    }

 


    //create image gallery 
    public function createAlbum(StoreGalleryRequest $request){


       $thumbnail =  $this->generateImage($request->name);

       DB::beginTransaction();
       try {
        $album = new Album();
        $album->name = $request->name;
        $album->thumbnail = $thumbnail;
        $album->user_id = Auth::user()->id;
        $album->save();
           DB::commit();
           Toastr::success('success', 'Album created successfully', ["positionClass" => "toast-top-right"]);
           return redirect()->route('create.album');
       } catch (\Throwable $e) {
           DB::rollBack();
           throw $e;
       }



}


    //Showing Edit gallery 
    public function editAlbum($id){

        //get authorised user id
        $user_id =  Auth::user()->id;

        //Get all gallery  according to  user id
        $albums = Album::where('user_id',$user_id)->get();

        //Get single gallery 
        $singleAlbum = Album::find($id);
        return view('album.create',compact('albums','singleAlbum'));
       
    }

    public function updateAlbum(StoreGalleryRequest $request,$id){
          
        $thumbnail =  $this->generateImage($request->name);

        DB::beginTransaction();
            try {
             $album =Album::find($id);
             $album->name = $request->name;
             $album->thumbnail = $thumbnail;
             $album->save();
             DB::commit();
             Toastr::success('success', 'Album Edit successfully', ["positionClass" => "toast-top-right"]);
                return redirect()->route('create.album');
            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }
    }


    //Create AI image and return this image 
    public function generateImage($album_name)
    {
       
        //generate the AI image using dalleApi
        $imageUrl = $this->dalleApiService->generateImage($album_name);
        
        //Generate a unique filename and extension
        $filename = Str::slug($album_name).'_'.uniqid().'.'.'png';
    
        // specify  the image path
        $path = '/images/thumbnails/'.$filename;

        //Store the image in the storage/public/images/thumbnails/ directory
         Storage::disk('local')->put($path,file_get_contents($imageUrl));
        
         //create image url to link storage
        $url =  Storage::url($path);

        //Return actual  image path
        return $url;
    }


    //Delete  gallery with thumbnail also
    public function deleteAlbum($id){
        
        $album = Album::find($id);
        
    if(Storage::delete($album->thumbnail)) {
        $album->delete();
        Toastr::success('Success', 'Album Delete Successfully', ["positionClass" => "toast-top-right"]);
    }else{
        Toastr::warning('Error', 'Thumbnail does not delete',  ["positionClass" => "toast-top-right"]);
    }
        
        return redirect()->route('create.album');
    }
}
