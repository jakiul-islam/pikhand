<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Services\ImageService;

use App\Models\Admin\banner;
use App\Models\Admin\notice;

class BannerController extends Controller
{
    public function create(request $request, ImageService $imageService){
      $validateUser =Validator::make(
        $request->all(),
          [
            'bannerName'         => 'required|string',
            'bannerSlog'         => 'required|string',
            'imageInput'         => 'required|mimes:jpeg,png,jpg,gif,jpej,webp,mp4,mov,avi,mkv|max:10250',
            'bannerDescription'  =>'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
          // 'dd' => dd(request()->all());
        ],401);
      }else{

        $file = $request->file('imageInput');

        $path = $imageService->upload(
                $file,
                'service',
                1200,
                80
            );

        
        $banner = banner::where('name',$request->bannerName)->where('slug',$request->bannerSlog)->count();
        if($banner > 0 ){
          return response()->json([
            'status' => false,
            'message'=>'Validation Error Is',
            'errors' =>'Use unic name and slug ',
          ],401);
        }else{
          $banner_create = banner::create([
            'name'         =>$request->bannerName,
            'slug'         =>$request->bannerSlog,
            'description'  =>$request->bannerDescription,
            'image'        =>$path,
          ]);
        }
        
        return response()->json([
          'ststus' => true,
          'message'=>'banner create Successfull',
          'banner_create' =>$banner_create,
        ],200);
      }
    }
    //fetch brands
    public function index(){
        $banner = banner::all();
        return response()->json($banner);
    }
    //eidte brands 
    public function notisefetch(){
        $notice = notice::all();
        return response()->json($notice);
    }
    //eidte brands 
    public function update(request $request ,ImageService $imageService){
      $validateUser =Validator::make(
        $request->all(),
          [
            'Editeid'           => 'required',
            'EditeBannersName'  => 'required|string',
            'EditeBannersSlug'  => 'required|string',
            'bannerDescription'  => 'required|string',
          ]
        );
      if(!empty($request->imageInput1)){
        $validateUser =Validator::make(
          $request->all(),
            [
              'imageInput1' => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            ]
        );
        if($validateUser->fails()){
          return response()->json([
            'ststus' => false,
            'message'=> "Validation errors is",
            'errors' =>$validateUser->errors()->all(),
          ],401);
        }else{

            $file = $request->file('imageInput1');

            $path = $imageService->upload(
                $file,
                'service',
                1200,
                80
            );
      
  
          $banner = banner::where('id',$request->Editeid)->first();
          Storage::disk('public')->delete($banner->image); 
          
          $bannerUpdate = $banner->update([
            'image' => $path,
          ]);
        }
      }
        if($validateUser->fails()){
          return response()->json([
            'ststus' => false,
            'message'=> "Validation errors is",
            'errors' =>$validateUser->errors()->all(),
          ],401);
        }else{
          $banner = banner::where('id',$request->Editeid)->first();
          $bannerUpdate = $banner->update([
            'name' => $request->EditeBannersName,
            'slug' => $request->EditeBannersSlug,
            'description' => $request->bannerDescription,
          ]);
          return response()->json([
            'ststus' => true,
            'message'=>'Banner update Successfull',
            'bannerUpdate' =>$bannerUpdate,
          ],200);
        }
      }
    
    //end edite brand 
    //delete brand
    public function delete(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'deleteId'  => 'required|integer',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
    
          $banner_delete = banner::where('id', $request->deleteId)->first();
          if ($banner_delete) {
            
           $imagePath = $banner_delete->image;

            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
             
              Storage::disk('public')->delete($imagePath);
            
              $deteletdata = banner::where('id', $request->deleteId)->delete();
              return response()->json([
                  'status' => true,
                  'message'=>'Category and image deleted successfully',
                  'user' =>$deteletdata,
              ],200);
          } else {
            return response()->json([
                'status' => false,
                'message'=>$imagePath,
            ],404);
          }
        }
      }
    }
  
  
  
  
}