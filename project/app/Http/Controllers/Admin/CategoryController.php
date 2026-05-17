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


class CategoryController extends Controller
{
    public function create(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'categoryName'     => 'required|string',
            'categorySlug'     => 'required|string',
            'imageInput'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            'categoryIcon'     => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            'categoryBanner'   => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            'featured'         => 'required|string',
            'categorymetatitle'=> 'required|string',
            'categoryMetaKayword'=> 'required|string',
            'MetaDescription'  => 'required|string',
            'shortDescription' => 'required|string',
            'langhDescription' => 'required|string',
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
        $img_path    = $request->file('imageInput')->store('catagory', 'public');
        $banner_path = $request->file('categoryBanner')->store('catagory/banner', 'public');
        $icon_path  = $request->file('categoryIcon')->store('catagory/icon', 'public');
        
        $category = categories::create([
          'name'=>$request->categoryName,
          'slug'=>$request->categorySlug,
          'meta_title'=>$request->categorymetatitle,
          'meta_keywords'=>$request->categoryMetaKayword,
          'meta_description'=>$request->MetaDescription,
          'short_description'=>$request->shortDescription,
          'description'=>$request->langhDescription,
          'featured'=>$request->featured,
          'image' => $img_path,
          'icon' => $icon_path,
          'banner' => $banner_path,
        ]);
        return response()->json([
          'ststus' => true,
          'message'=>'Category insert Successfull',
          'category' =>$category,
        ],200);
      }
    }
    //fetch category
    public function index(){
      $category     = categories::all();
      $subcategory  = product_subcategories::all();
      return response()->json([
        'subcategory' => $subcategory,
        'category'    => $category,
      ]);
    }
    //edite catagory function 
    public function update(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'EditCategoryId'        => 'required|string',
            'EditCategoryName'      => 'required|string',
            'EditCategorySlug'      => 'required|string',
            'EditMetaTitle'         => 'required|string',
            'EditMetakeyword'       => 'required|string',
            'EditMetaDescription'   => 'required|string',
            'EditShortDescription'  => 'required|string',
            'EditLanghDescription'  => 'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=> "Validation errors is",
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
          
        $edit_category = categories::where('id',$request->EditCategoryId)->first();
        // Category img edit systym
        if(empty($request->EditCategoryImg)){
          $img_path = $edit_category->image;
        }else{
          $validateUser =Validator::make(
            $request->all(),
              [
                'EditCategoryImg'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
              ]
            );
            if($validateUser->fails()){
              return response()->json([
                'ststus' => false,
                'message'=> "Validation errors is",
                'errors' =>$validateUser->errors()->all(),
              ],401);
            }else{
              $img_path = $request->file('EditCategoryImg')->store('catagory', 'public');
              $storage_img_path = storage_path('app/public/' . $edit_category->image);
              $public_img_path = public_path('public/' . $edit_category->image);
              File::delete($storage_img_path);
              File::delete($public_img_path);
            }
        }
        
        // Category icom edit systym
        if(empty($request->EditCategoryIcon)){
          $icon_path = $edit_category->icon;
        }else{
          $validateUser =Validator::make(
            $request->all(),
              [
                'EditCategoryIcon'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
              ]
            );
            if($validateUser->fails()){
              return response()->json([
                'ststus' => false,
                'message'=> "Validation errors is",
                'errors' =>$validateUser->errors()->all(),
              ],401);
            }else{
              $icon_path = $request->file('EditCategoryIcon')->store('catagory/icon', 'public');
              $storage_icon_path = storage_path('app/public/' . $edit_category->icon);
              $public_icon_path = public_path('public/' . $edit_category->icon);
              File::delete($storage_icon_path);
              File::delete($public_icon_path);
            }  
        }
        
         // Category banner edit systym
        if(empty($request->EditCategoryBanner)){
          $banner_path = $edit_category->banner;
        }else{
          $validateUser =Validator::make(
            $request->all(),
              [
                'EditCategoryBanner'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
              ]
            );
            if($validateUser->fails()){
              return response()->json([
                'ststus' => false,
                'message'=> "Validation errors is",
                'errors' =>$validateUser->errors()->all(),
              ],401);
            }else{
              $banner_path = $request->file('EditCategoryBanner')->store('catagory/banner','public');
              $storage_banner_path = storage_path('app/public/' . $edit_category->banner);
              $public_banner_path = public_path('public/' . $edit_category->banner);
              File::delete($storage_banner_path);
              File::delete($public_banner_path);
            }
        }
        
          $categories = categories::where('id',$request->EditCategoryId)->first();
          $categories->update([
            'name'               => $request->EditCategoryName,
            'slug'               => $request->EditCategorySlug,
            'meta_title'         => $request->EditMetaTitle,
            'meta_keywords'      => $request->EditMetakeyword,
            'meta_description'   => $request->EditMetaDescription,
            'short_description'  => $request->EditShortDescription,
            'description'        => $request->EditLanghDescription,
            'image'              => $img_path,
            'icon'               => $icon_path,
            'banner'             => $banner_path,
          ]);
          return response()->json([
            'ststus' => true,
            'message'=>'Category update successfull ',
            'categories' =>$categories,
          ],200);
        }
    }
    //delete catagory
    public function delete(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
          'deleteId'  => 'required|integer|exists:categories,id',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $chacksubcategory = product_subcategories::where('category_id',$request->deleteId)->count();
        if($chacksubcategory > 0){
          return response()->json([
            'status' => false,
            'message'=>'This category is used by '. $chacksubcategory .' subcategory',
          ],200);
        }else{
          $category = categories::where('id', $request->deleteId)->first();
          if ($category) {
            $imgPath = storage_path('app/public/' . $category->image);
            $imgPathpublic = public_path('public/' . $category->image);
            //icone path
            $iconPath = storage_path('app/public/' . $category->icon);
            $iconPathpublic = public_path('public/' . $category->icon);
            //banner 
            $bannerPath = storage_path('app/public/' . $category->banner);
            $bannerPathpublic = public_path('public/' . $category->banner);
              File::delete($imgPath);
              File::delete($imgPathpublic);
              
              File::delete($iconPath);
              File::delete($iconPathpublic);
              
              File::delete($bannerPath);
              File::delete($bannerPathpublic);
              
              $deteletdata = categories::where('id', $request->deleteId)->delete();
              return response()->json([
                'status' => true,
                'message'=>'Category removed successfully.',
                'user' =>$deteletdata,
              ],200);
          }else {
            return response()->json([
              'status' => false,
              'message'=>'Category not found',
            ],404);
          }
        }
      }
    }
    //category featured update
    public function featuredUpdate(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
          'featured'  => 'required',
          'categoryId'=> 'required|integer|exists:categories,id',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $categories = categories::where('id',$request->categoryId)->first();
        $categories->update([
          'featured'         => $request->featured,
        ]);
        return response()->json([
          'status'=>true ,
          'message' => 'Featured update successfull',
        ]);
      }
    }
    //category status update
    public function statusUpdate(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
          'statusSwitch'  => 'required',
          'categoryId'=> 'required|integer|exists:categories,id',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $categories = categories::where('id',$request->categoryId)->first();
        $chacksubcategory = product_subcategories::where('category_id',$request->categoryId)->count();
        if($chacksubcategory > 0){
          if($request->statusSwitch == 1){
            $categories->update([
            'status'         => $request->statusSwitch,
          ]);
          
          return response()->json([
            'status'=>true ,
            'message' => 'Category active successfull',
          ]);
          
          }else{
            return response()->json([
              'status'=>true ,
              'message'=>'This category is used by '. $chacksubcategory .' subcategory',
            ]);
          }
        }else{
          $categories->update([
            'status'         => $request->statusSwitch,
          ]);
          
          if($request->statusSwitch == 1){
            $message = 'Category active successfull';
          }else{
            $message = 'Category unactive successfull';
          }
          
          return response()->json([
            'status'=>true ,
            'message' => $message,
          ]);
        }
      }
    }
    //category deteails
    public function deteails(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
          'id'=> 'required|integer|exists:categories,id',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $categories = categories::with('subcategory')->where('id',$request->id)->first();
        return response()->json([
          'status'=>true ,
          'categories' => $categories,
        ]);
      }
    }

}
