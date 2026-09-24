<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use App\Services\ImageService;


use App\Models\Admin\categories;
use App\Models\Admin\product_subcategories;
use App\Models\Admin\product;


class CategoryController extends Controller
{
    public function create(request $request , ImageService $imageService){
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
          'status' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
          // 'dd' => dd(request()->all());
        ],401);
      }else{
        $img_file    = $request->file('imageInput');
        $banner_file = $request->file('categoryBanner');
        $icon_file  = $request->file('categoryIcon');

//asdyfhasjdfhkjsahdfsad fausdf basdfb asdfr



        
         $img_path = $imageService->upload(
                $img_file,
                'category',
                1200,
                80
            );
         $banner_path = $imageService->upload(
                $banner_file,
                'category/banner',
                1200,
                80
            );
         $icon_path = $imageService->upload(
                $icon_file,
                'category/icon',
                1200,
                80
            );

        
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
          'status' => true,
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
    public function update(request $request , ImageService $imageService){
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
          'status' => false,
          'message'=> "Validation errors is",
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
          
        $edit_cetegory = categories::where('id',$request->EditCategoryId)->first();
        // Category img edit systym
        if($request->EditCategoryImg){
          $validateUser =Validator::make(
            $request->all(),
              [
                'EditCategoryImg'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
              ]
            );
            if($validateUser->fails()){
              return response()->json([
                'status' => false,
                'message'=> "Validation errors is",
                'errors' =>$validateUser->errors()->all(),
              ],401);
            }else{
              $edit_img_file = $request->file('EditCategoryImg');

              $edit_img_path = $imageService->upload(
                $edit_img_file,
                'category',
                1200,
                80
              );
              
              Storage::disk('public')->delete($edit_cetegory->image); 

              $categories->update([
                'image'              => $edit_img_path,
              ]);
              
            }
        }
        
        // Category icom edit systym
        if($request->EditCategoryIcon){
          $validateUser =Validator::make(
            $request->all(),
              [
                'EditCategoryIcon'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
              ]
            );
            if($validateUser->fails()){
              return response()->json([
                'status' => false,
                'message'=> "Validation errors is",
                'errors' =>$validateUser->errors()->all(),
              ],401);
            }else{
              
              $edit_icon_file = $request->file('EditCategoryIcon');

              $edit_icon_path = $imageService->upload(
                $edit_icon_file,
                'category/icon',
                1200,
                80
              );
              
              Storage::disk('public')->delete($edit_cetegory->icon); 

              $categories->update([
                'icon'              => $edit_icon_path,
              ]);
              
            }  
        }
        
         // Category banner edit systym
        if($request->EditCategoryBanner){
          $validateUser =Validator::make(
            $request->all(),
              [
                'EditCategoryBanner'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
              ]
            );
            if($validateUser->fails()){
              return response()->json([
                'status' => false,
                'message'=> "Validation errors is",
                'errors' =>$validateUser->errors()->all(),
              ],401);
            }else{
     
                            
              $edit_banner_file = $request->file('EditCategoryBanner');

              $edit_banner_path = $imageService->upload(
                $edit_banner_file,
                'category/banner',
                1200,
                80
              );
              
              Storage::disk('public')->delete($edit_cetegory->icon); 

              $categories->update([
                'banner'              => $edit_banner_path,
              ]);

              
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
            'status' => true,
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
          'status' => false,
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
          'status' => false,
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
          'status' => false,
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
