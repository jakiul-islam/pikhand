<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\admin\brand;
use App\Models\admin\product;


class BrandController extends Controller
{
    public function create(request $request){
      $validate_brand =Validator::make(
        $request->all(),
          [
            'brandName'          => 'required|string',
            'brandSlog'          => 'required|string',
            'metaTitle'          => 'required|string',
            'metaKeyword'        => 'required|string',
            'metaDescription'    => 'required|string',
            'imageInput'         => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            'brand_describtion'  =>'required|string',
          ]
      );
      if($validate_brand->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validate_brand->errors()->all(),
        ],401);
      }else{
        $path = $request->file('imageInput')->store('brand', 'public');
        $brand = brand::create([
          'name'              =>$request->brandName,
          'slug'              =>$request->brandSlog,
          'meta_title'        =>$request->brandSlog,
          'meta_keyword'      =>$request->brandSlog,
          'meta_description'  =>$request->brandSlog,
          'description'       =>$request->brand_describtion,
          'logo'              => $path,
        ]);
        return response()->json([
          'ststus' => true,
          'message'=>'insert img Successfull',
           'brand' =>$brand,
        ],200);
      }
    }
    //fetch brands
    public function index(){
      $brand = brand::all();
      $product = product::all();
      return response()->json([
        'brand' => $brand,
        'product' => $product,
      ]);
    }
    //eidte brands 
    public function update(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'id'              => 'required|string',
            'name'            => 'required|string',
            'slug'            => 'required|string',
            'meta_title'      => 'required|string',
            'meta_keyword'    => 'required|string',
            'meta_description'=> 'required|string',
            'description'     => 'required|string',
          ]
        );
      $brand = brand::where('id',$request->id)->first();
      if(!empty($request->img)){
        $validateUser =Validator::make(
          $request->all(),
            [
              'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            ]
        );
        if($validateUser->fails()){
          return response()->json([
            'ststus' => false,
            'message'=> "Validation errors is",
            'errors' =>$validateUser->errors()->all(),
          ],401);
        }else{
          $path = $request->file('img')->store('brand', 'public');
          $editeimagePath = storage_path('app/public/' . $brand->logo);
          $editeimagePathpub = public_path('public/' . $brand->logo);
          File::delete($editeimagePath);
          File::delete($editeimagePathpub);
        }
      }else {
        $path = $brand->logo;
      }
      if(empty($path)){
        return response()->json([
          'ststus' => false,
          'message'=> "please give me veleate img",
        ],401);
      }else{
        if($validateUser->fails()){
          return response()->json([
            'ststus' => false,
            'message'=> "Validation errors is",
            'errors' =>$validateUser->errors()->all(),
          ],401);
        }else{
          $brand_update = $brand->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'logo' =>$path,
          ]);
          return response()->json([
            'ststus' => true,
            'message'=>'Brand update Successfull',
            'brand_update' =>$brand_update,
          ],200);
        }
      }
    }
    
    //end edite brand 
    //delete brand
    public function delete(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'id'  => 'required|integer|exists:brands,id',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
      //delete
        $chackProduct = product::where('brand_id', $request->id)->count();
        if($chackProduct){
          return response()->json([
            'status' => false,
            'message'=>'This brand use by'.$chackProduct.'product',
          ],200);
        }else{
          $brand_delete = brand::where('id', $request->id)->first();
          if ($brand_delete) {
            $imagePath = storage_path('app/public/' . $brand_delete->logo);
            $imagePathpub = public_path('public/' . $brand_delete->logo);
            // ইমেজ ফাইল এক্সিস্ট করে কি না চেক করে ডিলিট করুন
              File::delete($imagePath);
              File::delete($imagePathpub);
              $deteletdata = brand::where('id', $request->id)->delete();
              return response()->json([
                'status' => true,
                'message'=>'Brand deleted successfull',
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
    //brand status update 
    public function statusUpdate(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'id'            => 'required|integer|exists:brands,id',
            'statusSwitch'  => 'required|integer',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
      //delete
        $brand = brand::where('id', $request->id)->first();
        
        $chackProduct = product::where('brand_id', $request->id)->count();
        if($chackProduct > 0){
          if($request->statusSwitch == 1){
            $brand->update([
              'status' => $request->statusSwitch,
            ]);
            return response()->json([
              'status' => true,
              'message'=>'Brand active successfull',
            ],200);
          }else{
            return response()->json([
              'status' => false,
              'message'=>'This brand use by'.$chackProduct.'product',
            ],200);
          }
        }else{
          $brand->update([
            'status' => $request->statusSwitch,
          ]);
          if($request->statusSwitch == 1){
            $message = 'Brand active successfull';
          }else{
            $message = 'Brand unactive successfull';
          }
          return response()->json([
            'status' => true,
            'message'=>$message,
          ],200);
        }
      }
    }

    
}