<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\sosial_media_link;


class MediaLinksController extends Controller
{
    //insert media
    public function insertMediaLinks(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            
            'mediaType'   => 'required|string|max:255',
            'mediaUrl'    => 'required|url|max:255',
            'mediaIcon'   => 'required|string|max:255',
            'mediaIdName' => 'required|string|max:255',
            
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{

        $insert_media = sosial_media_link::create([
          'type'   =>$request->mediaType,
          'url'    =>$request->mediaUrl,
          'icon'   =>$request->mediaIcon,
          'name'   =>$request->mediaIdName,
        ]);
        return response()->json([
          'ststus' => true,
          'massege'=>'media insert Successfull',
          'user' =>$insert_media,
        ],200);
      }
    }
    //fetch media 
    public function fetchMediaLinks(request $request){
      
      $media = sosial_media_link::all();
      
      return response()->json([
        'ststus' => true,
        'media'  => $media,
      ],200);
      
    }
   
}
