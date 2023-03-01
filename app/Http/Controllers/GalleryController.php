<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Services\DalleApiService;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreGalleryRequest;

class GalleryController extends Controller
{
    //

    protected $generateSingleImage;

    public function create(){
        $user_id =  Auth::user()->id;
        $gallries = Gallery::where('user_id',$user_id)->get();
        return view('gallery.create',compact('gallries'));
    }

    protected $dalleApiService;

    public function __construct(DalleApiService $dalleApiService)
    {
        $this->dalleApiService = $dalleApiService;
    }


    //create image gallery 
    public function createGallery(StoreGalleryRequest $request){


       $thumbnail =  $this->generateImage($request->name);

       DB::beginTransaction();
       try {
        $gallery = new Gallery();
        $gallery->name = $request->name;
        $gallery->thumbnail = $thumbnail;
        $gallery->user_id = Auth::user()->id;
        $gallery->save();
           DB::commit();
           Toastr::success('success', 'Gallery created successfully', ["positionClass" => "toast-top-right"]);
           return redirect()->route('create.gallery');
       } catch (\Throwable $e) {
           DB::rollBack();
           throw $e;
       }



}


        //Showing Edit gallery 
        public function editGallery($id){
            $user_id =  Auth::user()->id;
            $gallries = Gallery::where('user_id',$user_id)->get();
            $singleGallery = Gallery::find($id);
            return view('gallery.create',compact('gallries','singleGallery'));
        }

        public function updateGallery(StoreGalleryRequest $request,$id){
            $thumbnail =  $this->generateImage($request->name);
            DB::beginTransaction();
            try {
             $gallery =Gallery::find($id);
             $gallery->name = $request->name;
             $gallery->thumbnail = $thumbnail;
             $gallery->save();
                DB::commit();
                Toastr::success('success', 'Gallery Edit successfully', ["positionClass" => "toast-top-right"]);
                return redirect()->route('create.gallery');
            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }
        }


    //Create AI image and return this image 
    public function generateImage($prompt)
    {
        //return dalleApi image 
        $imageUrl = $this->dalleApiService->generateImage($prompt);
        return $imageUrl;
    }


   
}
