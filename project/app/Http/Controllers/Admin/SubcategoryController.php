<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\categories;
use App\Models\Admin\product_subcategories;
use App\Models\Admin\product;



class SubcategoryController extends Controller
{
    // insert subcategory 
    public function create(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'categoryId'                   =>'required|string',
            'subcategoryName'              =>'required|string',
            'subcategorySlug'              =>'required|string',
            'subcategoryMetaTitle'         =>'required|string',
            'subcategoryMetaKayword'       =>'required|string',
            'featured'                     =>'required|string',
            'subcategoryImg'               => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            'subcategoryIcon'              => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            'subcategoryBanner'            => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            'subcategoryMetaDescription'   =>'required|string',
            'subcategoryShortDescription'  =>'required|string',
            'subcategoryLongDescription'  =>'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        // file moved section
        $img_path    = $request->file('subcategoryImg')->store('subcategory', 'public');
        $icon_path= $request->file('subcategoryIcon')->store('subcategory/banner', 'public');
        $banner_path  = $request->file('subcategoryBanner')->store('subcategory/icon', 'public');
        
        // data insert section
        $product_subcategories = product_subcategories::create([
          'name'               =>$request->subcategoryName,
          'slug'               =>$request->subcategorySlug,
          'meta_title'         =>$request->subcategoryMetaTitle,
          'image'              =>$img_path,
          'icon'               =>$icon_path,
          'banner'             =>$banner_path,
          'meta_keyword'       =>$request->subcategoryMetaKayword,
          'featured'           =>$request->featured,
          'meta_description'   =>$request->subcategoryMetaDescription,
          'short_description'  =>$request->subcategoryShortDescription,
          'long_description'  =>$request->subcategoryLongDescription,
          'category_id'        => $request->categoryId,
        ]);
        return response()->json([
          'ststus' => true,
          'message'=>'Subcategory insert successfull',
          'product_subcategories' =>$product_subcategories,
        ],200);
      }
    }
    
    //index subcategory 
    
    public function index( request $request ){
      $validateUser =Validator::make(
        $request->all(),
          [
            'categoryId'                   =>'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $subcategory       = product_subcategories::where('category_id',$request->categoryId)->get();
        $subcategory_count = product_subcategories::where('category_id',$request->categoryId)->count();
        if($subcategory){
          return response()->json([
            'categoryId'        => $request->categoryId,
            'subcategory'       => $subcategory,
            'subcategory_count' => $subcategory_count,
          ]);
        }
      }
    }
    
    
    //set old date 
    public function oldData( request $request ){
      $validateUser =Validator::make(
        $request->all(),
          [
            'subcategoryId'                   =>'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $subcategory       = product_subcategories::where('id',$request->subcategoryId)->first();
        if($subcategory){
          return response()->json([
            'subcategory'       => $subcategory,
          ]);
        }
      }
    }

    //update subcategory 
    public function update(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'id'               => 'required',
            'name'             => 'required|string|max:255',
            'slug'             => 'required|string|max:255',
            'metaTitle'        => 'required|string|max:255',
            'metaKeyword'      => 'required|string|max:255',
            'featured'         => 'required|string|max:255',
            'metaDescription'  => 'required|string',
            'shortDescription' => 'required|string',
            'longDescription'  => 'required|string',
            
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=> "Validation errors is",
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        
        $product_subcategories = product_subcategories::where('id',$request->id)->first();
        
        
        // Category icom edit systym
        if(empty($request->Img)){
          $img_path = $product_subcategories->image;
        }else{
          $validateUser =Validator::make(
            $request->all(),
              [
                'Img'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
              ]
            );
            if($validateUser->fails()){
              return response()->json([
                'ststus' => false,
                'message'=> "Validation errors is",
                'errors' =>$validateUser->errors()->all(),
              ],401);
            }else{
              $img_path = $request->file('Img')->store('subcatagory', 'public');
              $storage_img_path = storage_path('app/public/' . $product_subcategories->icon);
              $public_img_path = public_path('public/' . $product_subcategories->icon);
              File::delete($storage_img_path);
              File::delete($public_img_path);
            }  
        }
        
        // Category icom edit systym
        if(empty($request->Icon)){
          $icon_path = $product_subcategories->icon;
        }else{
          $validateUser =Validator::make(
            $request->all(),
              [
                'Icon'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
              ]
            );
            if($validateUser->fails()){
              return response()->json([
                'ststus' => false,
                'message'=> "Validation errors is",
                'errors' =>$validateUser->errors()->all(),
              ],401);
            }else{
              $icon_path = $request->file('Icon')->store('subcatagory/icon', 'public');
              $storage_icon_path = storage_path('app/public/' . $product_subcategories->icon);
              $public_icon_path = public_path('public/' . $product_subcategories->icon);
              File::delete($storage_icon_path);
              File::delete($public_icon_path);
            }  
        }
        
         // Category banner edit systym
        if(empty($request->Banner)){
          $banner_path = $product_subcategories->banner;
        }else{
          $validateUser =Validator::make(
            $request->all(),
              [
                'Banner'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
              ]
            );
            if($validateUser->fails()){
              return response()->json([
                'ststus' => false,
                'message'=> "Validation errors is",
                'errors' =>$validateUser->errors()->all(),
              ],401);
            }else{
              $banner_path = $request->file('Banner')->store('subcatagory/banner','public');
              $storage_banner_path = storage_path('app/public/' . $product_subcategories->banner);
              $public_banner_path = public_path('public/' . $product_subcategories->banner);
              File::delete($storage_banner_path);
              File::delete($public_banner_path);
            }
        }
        
        
        $product_subcategories->update([
          'name'             => $request->name,
          'slug'             => $request->slug,
          'meta_title'       => $request->metaTitle,
          'meta_keyword'     => $request->metaKeyword,
          'featured'         => $request->featured,
          'image'            => $img_path,
          'icon'             => $icon_path,
          'banner'           => $banner_path,
          'mata_description' => $request->metaDescription,
          'short_description'=> $request->shortDescription,
          'long_description' => $request->longDescription,
        ]);
        
          return response()->json([
            'ststus' => true,
            'message'=>'Subcategory update successfull',
            'product_subcategories' =>$product_subcategories,
          ],200);
          
        return response()->json([
          'ststus' => false,
          'message'=>'Subcategory updete faild .',
          'errors' =>$validateUser->errors()->all(),
        ],401);
        
      }
    }
    //featured update 
    public function featuredUpdate(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'subcategoryId' => 'required|integer|exists:product_subcategories,id', // subcategoryId চেক করবে
            'featured' => 'required|boolean', // featured চেক করবে
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=> "Validation errors is",
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $product_subcategories = product_subcategories::where('id',$request->subcategoryId)->first();
        
        $product_subcategories->update([
          'featured'         => $request->featured,
        ]);
          
          
          if ($request->featured == 1) {
            $message = 'Subcategory featured checked successfully';
          } else {
            $message = 'Subcategory featured unchecked successfully';
          }

          return response()->json([
            'status' => true,
            'message' => $message,
            'product_subcategories' => $product_subcategories,
          ], 200);

        return response()->json([
          'status' => false,
          'message'=>'Subcategory updete faild .',
          'errors' =>$validateUser->errors()->all(),
        ],401);
        
      }
    }
    //status update 
    public function statusUpdate(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'subcategoryId' => 'required|integer|exists:product_subcategories,id', // subcategoryId চেক করবে
            'status' => 'required|boolean', // featured চেক করবে
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=> "Validation errors is",
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $product_subcategories = product_subcategories::where('id',$request->subcategoryId)->first();
        
        $product_subcategories->update([
          'status'         => $request->status,
        ]);
       
        if ($request->status == 1) {
            $message = 'Subcategory active successfully';
        } else {
            $message = 'Subcategory unactive successfully';
        }
        
         return response()->json([
            'ststus' => true,
            'message'=>$message,
            'product_subcategories' =>$product_subcategories,
          ],200);
          
        return response()->json([
          'ststus' => false,
          'message'=>'Subcategory updete faild .',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }
    }
    //delete subcategory 
    public function delete(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'Id'  => 'required|integer|exists:product_subcategories,id',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=> "Validation errors is",
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $product_subcategories =  product_subcategories::where('id',$request->Id)->delete();
        
        if($product_subcategories){
          return response()->json([
            'ststus' => true,
            'message'=>'Subcategory delete successfull',
            'product_subcategories' =>$product_subcategories,
          ],200);
        }else{
          return response()->json([
            'ststus' => false,
            'message'=>'Subcategory delete faild',
          ],401);
        }
      }
    }
    //category deteails
    public function deteails(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
          'id'=> 'required|integer|exists:product_subcategories,id',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $product_subcategories = product_subcategories::find($request->id);
        return response()->json([
          'status'=>true ,
          'product_subcategories' => $product_subcategories,
        ]);
      }
    }

}
