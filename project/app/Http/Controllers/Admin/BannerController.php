<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\banner;
use App\Models\Admin\notice;

class BannerController extends Controller
{
    public function create(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'bannerName'         => 'required|string',
            'bannerSlog'         => 'required|string',
            'imageInput'         => 'required|image|mimes:jpeg,png,jpg,gif,jpej,webp|max:10250',
            'bannerDescription'  =>'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
          // 'dd' => dd(request()->all());
        ],401);
      }else{

        $path = $request->file('imageInput')->store('service', 'public');
       
        $banner_create = banner::create([
          'name'         =>$request->bannerName,
          'slug'         =>$request->bannerSlog,
          'description'  =>$request->bannerDescription,
          'image'        =>$path,
        ]);
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
    public function update(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'Editeid'           => 'required',
            'EditeBannersName'  => 'required|string',
            'EditeBannersSlug'  => 'required|string',
            'EditeMinPrice'     =>'required|string',
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
          $path = $request->file('imageInput1')->store('service', 'public');
          $brand = banner::where('id',$request->Editeid)->first();
          $editeimagePath = storage_path('app/public/' . $brand->logo);
          $editeimagePathpub = public_path('public/' . $brand->logo);
          File::delete($editeimagePath);
          File::delete($editeimagePathpub);
        }
      }else {
        $validateUser =Validator::make(
          $request->all(),
            [
              'old_image' => 'required',
            ]
        );
        if($validateUser->fails()){
          return response()->json([
            'ststus' => false,
            'message'=> "Validation errors is",
            'errors' =>$validateUser->errors()->all(),
          ],401);
        }else{
          $path = $request->input('old_image');
        }
      }
      if(empty($path)){
        return response()->json([
          'ststus' => false,
          'message'=> "pless give me veleate img",
        ],401);
      }else{
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
            'st_price' => $request->EditeMinPrice,
            'logo' =>$path,
          ]);
          return response()->json([
            'ststus' => true,
            'message'=>'Banner update Successfull',
            'bannerUpdate' =>$bannerUpdate,
          ],200);
        }
      }
    }
    
    //end edite brand 
    //delete brand
    public function deleteservices(request $request){
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
    
          $brand_delete = banner::where('id', $request->deleteId)->first();
          if ($brand_delete) {
            $imagePath = storage_path('app/public/' . $brand_delete->logo);
            $imagePathpub = public_path('public/' . $brand_delete->logo);
            // ইমেজ ফাইল এক্সিস্ট করে কি না চেক করে ডিলিট করুন
            if (File::exists($imagePath)) {
              File::delete($imagePath);
              File::delete($imagePathpub);
              $deteletdata = banner::where('id', $request->deleteId)->delete();
              return response()->json([
                  'status' => true,
                  'message'=>'Category and image deleted successfully',
                  'user' =>$deteletdata,
              ],200);
          } else {
            return response()->json([
                'status' => false,
                'message'=>'Category not found',
            ],404);
          }
        }
      }
    }
  
  
  
  
}