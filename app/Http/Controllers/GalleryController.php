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

class GalleryController extends Controller
{
    //

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
                
               
                $imageOb = new Image();
                $imageOb->title = $request->title;
                $imageOb->album_id = $request->album_id;

                if($request->hasfile('files')){
                    $images = $request->file('files');
                    foreach ($images as $index=>$image) {
                    $imageName = uniqid().'.'.$image->getClientOriginalExtension();
                    $path = 'public/images/'.$imageName;
                    Storage::put($path,file_get_contents($image));
                    $url =  Storage::url($path);
                    
                    $imageOb->image =  $url;
                    $imageOb->save();
                }
              
                  }
                
                DB::commit();
                Toastr::success('success', 'Image  Upload successfully', ["positionClass" => "toast-top-right"]);
                return redirect()->back();

            }catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }
          
            
        }

        

   
}
