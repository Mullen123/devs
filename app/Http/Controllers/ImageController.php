<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageController extends Controller
{
   
  
    public function store(Request $request)
    {


        $image = $request->file('file');
        /*generamos un id unico a la imagen*/
        $imageName = Str::uuid(). ".". $image->extension();
        $imageServer = Image::make($image);
        $imageServer->fit(500,500);
        $imagePath = public_path('image/uploads'). '/' .$imageName;
        $imageServer->save($imagePath);


        //return $request->file('file')->store('image','public');
        return response()->json(['image'=> $imageName]);
    }

    
}
