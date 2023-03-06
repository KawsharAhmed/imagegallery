<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\DalleApiService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ImageRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreGalleryRequest;
use App\Models\Image;
use App\Traits\UploadTrait;

class GalleryController extends Controller
{
    // 
    
    use UploadTrait;

        public function index($id){
            $album = Album::find($id);
            $images = Image::where('album_id',$id)->get();
            return view('gallery.index',compact('images','album'));
        }
        public function createImage(){
            $user_id =  Auth::user()->id;
            $albums = Album::where('user_id',$user_id)->get();
            $images = DB::table('albums')
            ->join('images', 'albums.id', '=', 'images.album_id')
            ->select('images.*', 'albums.user_id','albums.name')
            ->where('albums.user_id', '=', $user_id)
            ->get();
                       
            return view('gallery.image',compact('images','albums'));
        }


        public function uploadImage(ImageRequest $request){

         
            DB::beginTransaction();
            try{
                
               
                //Create new image
                $imageOb = new Image();
                $imageOb->title = $request->title;
                $imageOb->album_id = $request->album_id;

                //check image has been uploaded

                if($request->has('image')){

                    //get iamge file
                    $image = $request->file('image');
                    
                    //Make a image name based on user name and current  timestamp
                    $name = Str::slug($request->title).'_'.time();

                    //Define a folder path
                    $folder = '/images/album/';

                    //Make a file path image sill be stored;

                    $filepath = $folder .$name.'.'. $image->getClientOriginalExtension();

                    //Upload Image 
                    $this->uploadFile($image,$folder,'public',$name);

                    //Set  image path in database to filePath
                    $imageOb->image = Storage::url($filepath);

                }
                $imageOb->save();

                DB::commit();
                Toastr::success('success', 'Image  Upload successfully', ["positionClass" => "toast-top-right"]);
                return redirect()->back();

            }catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }
          
            
        }

        //Delete image

        public function deleteImage($id){
        
            $image = Image::find($id);
            
        if(Storage::delete($image->image)) {
            $image->delete();
            Toastr::success('Success', 'Image Delete Successfully', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('Error', 'Image does not delete',  ["positionClass" => "toast-top-right"]);
        }
            
            return redirect()->route('create.image');
        }

   
}
