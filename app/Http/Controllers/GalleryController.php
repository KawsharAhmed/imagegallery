<?php

namespace App\Http\Controllers;
use App\Services\DalleApiService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    //

    public function create(){
        return view('gallery.create');
    }

    protected $dalleApiService;

    public function __construct(DalleApiService $dalleApiService)
    {
        $this->dalleApiService = $dalleApiService;
    }


   
    public function generateImage(Request $request)
    {
       
        $prompt = $request->input('image');
       
        $imageUrl = $this->dalleApiService->generateImage($prompt);
        return $imageUrl;
        // return view('image', ['imageUrl' => $imageUrl]);
    }
}
