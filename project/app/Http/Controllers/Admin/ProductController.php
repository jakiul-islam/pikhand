<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


use App\Models\Admin\product;
use App\Models\Admin\category_product;
use App\Models\Admin\product_subcategories;
use App\Models\Admin\table_product_imgs;
use App\Models\product_reviews;

class ProductController extends Controller
{
  //insert prodect section
  public function create(Request $request){
    $validateProduct =Validator::make(
      $request->all(),
      [
        'name'       => 'required|string|max:255',
        'keyword'    => 'required|string|max:255',
        'metaTitle'  => 'required|string|max:255',
        'category'   => 'required',
        'price'      => 'required|numeric|min:0',
        'avolalabe'  => 'required|integer|min:0',
        
        'code'       => 'required|string|unique:products,product_code,',
        'sku'        => 'required|string|unique:products,sku,',
        'weight'     => 'required|string|min:0',
        'dimensions' => 'required|string|min:0',
        'color'      => 'required|string|min:0',
        'size'       => 'required|string|min:0',
        'material'   => 'required|string|min:0',
        'warranty'   => 'required|string|min:0',
      'return-policy'=> 'required|string|min:0',
        
        'discount'          => 'required|numeric|min:0|max:100',
        'image'             => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        'MetaDescription'   => 'required|string',
        'ShortDescription'  => 'required|string',
        'LongDescription'   => 'required|string',
      ]
    );
        
    if($validateProduct->fails()){
      return response()->json([
        'status' => false,
        'message'=>'Validation Error Is',
        'errors' =>$validateProduct->errors()->all(),
      ],422);
    }else{
      
      $path = $request->file('image')->store('productDifolt', 'public');
      $productId = product::create([
        'name'            =>$request->name,
        'slug'            =>$request->keyword,
        'mata_title'      =>$request->metaTitle,
        'price'           =>$request->price,
        'discount'        =>$request->discount,
        'stock'           =>$request->avolalabe,
        'product_code'    =>$request->code,
        
        'sku'             =>$request->sku,
        'weight'          =>$request->weight,
        'dimensions'      =>$request->dimensions,
        'color'           =>$request->color,
        'size'            =>$request->size,
        'material'        =>$request->material,
        'warranty'        =>$request->warranty,
        'return_policy'   =>$request->color,
        
        'category_id'     => '213' ,
        'brand_id'        => '213' ,
        'total_sales'     => '213',
      'mata_description'  =>$request->MetaDescription,
      'short_description' =>$request->ShortDescription,
        'long_description'=>$request->LongDescription,
        'image'           => $path,
      ])->id;  
      
      
      $ids =  $request->category;
      if (is_string($ids)) {
        $id = explode(',', $ids);
      }
      
      $rows = [];
      foreach ( $id as $cid) {
        $rows[] = ['product_id' => $productId, 'subcategory_id' => $cid];
      }
      category_product::insert($rows); 
      
      
      
      return response()->json([
        'status' => true ,
        'message'=>'Product create successfull',
      ],201);
    }
  }
    
  //product Fetch section 
  public function index( Request $request ){
      
    $page = $request->page ;
    $search_input = $request->search_input;
    $select = $request->select;
    $time = $request->time;
    
    $perPage = 9;


      $query = product::orderBy('id', 'desc'); // আগে শুধু orderBy

      // সব where কন্ডিশন আগে অ্যাড করো
      if ($request->search_input) {
          $query->where('name', 'like', '%' . $request->search_input . '%');
      }
      
      if ($request->select != 'All') {
          $query->where('status', $request->select);
      }
      
      if ($request->time) {
          $time = Carbon::parse($request->time)->format('Y-m-d H:i:s');
          $query->where('created_at', '>', $time);
      }
      
      // সবার শেষে skip, take, get
      $products = $query->skip(($page - 1) * $perPage)
                        ->take($perPage)
                        ->get();
      
      // nextPage বের করার জন্য total count ও লাগবে
      $totalCount = $query->count(); // কিন্তু এটা get() এর আগে করতে হবে
      
      // তাই ভালো হয় এভাবে:
      $totalCount = $query->count(); // count আগে
      
      $products = $query->skip(($page - 1) * $perPage)
                        ->take($perPage)
                        ->get();
           
     
     
    $productscount = $products->count();
      
    $brand               = DB::table('brands')->get();
    $categories          = DB::table('categories')->get();
    $table_product_imgs  = table_product_imgs::all();
    $subcategories       = product_subcategories::all();
    $category_product    = category_product::all();
      
      
    return response()->json([
      'products'         => $products,
      'productscount'    => $productscount,
      'brands'           => $brand,
      'categories'       => $categories,
      'product_img'      => $table_product_imgs,
      'subcategories'    => $subcategories,
      'category_product' => $category_product,
      'nextPagee' => $page,
      'nextPage' => count($products) == $perPage ? $page + 1 : null
    ]);
  }
  
  //product active unactive section 
  public function statusUpdate(request $request){
    $validateAction=Validator::make(
      $request->all(),[
        'id' =>'required|integer|exists:products,id',
        'status'=>'required|integer',
        ]
      );
      if($validateAction->fails()){
        return response()->json([
          'status' => false,
          'massege'=> 'error is ',
          'errors' => $validateAction->errors()->all(),
        ],401);
      }else{
        $product = product::where('id',$request->id)->first();
        $product->update([
          'status' => $request->status,
        ]);
        if($request->status == 1){
          return response()->json([
            'status'=>true,
            'message'=>"Product active Successfull",
          ],201);
        }else{
          return response()->json([
            'status'=>true,
            'message'=>"Product unactive Successfull",
          ]);
        }
      }
  }
  
  //product edit section 
  public function update(request $request){
    $validateEditProduct =Validator::make(
      $request->all(),
        [ 
          'editProductId' => 'required|string|max:255',
          'editProductName' => 'required|string|max:255',
          'editProductKeyword' => 'required|string|max:255',
          'editProductmetatitle' => 'required|string|max:255',
          'editProductPrice' => 'required|numeric',
          'editProductAvolalabe' => 'required|numeric',
          'editProductDiscount' => 'required|numeric|max:100',
          'editProductCode' => 'required|string|max:255',
          'editProductSku' => 'required|string|max:255',
          'editWeight' => 'required|string|max:255',
          'editDimensions' => 'required|string|max:255',
          'editColor' => 'required|string|max:255',
          'editSize' => 'required|string|max:255',
          'editMaterial' => 'required|string|max:255',
          'editWarranty' => 'required|string|max:255',
          'editReturnPolicy' => 'required|string|max:255',
          'editMetadescription' => 'required|string',
          'editShortdescription' => 'required|string',
          'editLongdescription' => 'required|string',
        ]
    );
    if($validateEditProduct->fails()){
      return response()->json([
        'status' => false,
        'massege'=> 'error is ',
        'errors' => $validateEditProduct->errors()->all(),
        ],401);
    }else{

      if(!empty($request->editProductImg)){
        $validateEditProduct =Validator::make(
            $request->all(),
            [
            'editProductImg' => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            ]
        );
        if($validateEditProduct->fails()){
          return response()->json([
            'status' => false,
            'massege'=> 'error is ',
            'errors' => $validateEditProduct->errors()->all(),
            ],401);
        }else{
          $path = $request->file('editProductImg')->store('productDifolt', 'public');
            
          $product_img = product::where('id',$request->editProductId)->first();
          
          $product_img->update([
            'image' => $path,
          ]);
          
          
          $editeimagePath = storage_path('app/public/' . $product_img->image);
          $editeimagePathpub = public_path('public/' . $product_img->image);
        
        
          File::delete($editeimagePath);
          File::delete($editeimagePathpub);
        }
      }
      
      
        $product = product::where('id',$request->editProductId)->first();
        $product->update([
          'name' => $request->editProductName,
          'slug' => $request->editProductKeyword,
          'mata_title' => $request->editProductmetatitle,
          'price' => $request->editProductPrice,
          'discount' => $request->editProductDiscount,
          'stock' => $request->editProductAvolalabe,
          'product_code' => $request->editProductCode,
          'sku' => $request->editProductSku,
          'weight' => $request->editWeight,
          'dimensions' => $request->editDimensions,
          'color' => $request->editColor,
          'size' => $request->editSize,
          'material' => $request->editMaterial,
          'warranty' => $request->editWarranty,
          'return_policy' => $request->editReturnPolicy,
          'mata_description' => $request->editMetadescription,
          'short_description' => $request->editShortdescription,
          'long_description' => $request->editLongdescription,
        ]);
        
        //editSubcategory section
        if(!empty($request->editSubcategory)){
          $validateEditProduct =Validator::make(
              $request->all(),
              [
              'editSubcategory' => 'required|string',
              ]
          );
          if($validateEditProduct->fails()){
            return response()->json([
              'status' => false,
              'massege'=> 'error is ',
              'errors' => $validateEditProduct->errors()->all(),
              ],401);
          }else{
            
            $productAndcategorylingdelete = category_product::where('product_id',$request->editProductId)->delete();
            if (is_string( $request->editSubcategory )) {
              $id = explode(',', $request->editSubcategory);
            }
            $rows = [];
            foreach ( $id as $cid) {
              $rows[] = ['product_id' => $request->editProductId, 'subcategory_id' => $cid];
            }
            category_product::insert($rows);
            
          }
        }


        
        return response()->json([
          'ststus' => true,
          'message'=>'product updata Successfull',
          'product' =>$product,
        ],200);
    }
  }

  //product delete section
  public function delete(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'id'  => 'required|integer|exists:products,id',
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
        $productdeletepath = product::where('id', $request->id)->first();
        $FetchProductImg = table_product_imgs::where('product_id',$request->id)->get();
        
        if($FetchProductImg){
          foreach ($FetchProductImg as $productImgs ){
             $image = storage_path('app/public/' . $productImgs->images);
             $imagepub = public_path('public/' . $productImgs->images);
             File::delete($image);
             File::delete($imagepub);
          }
          $deteletdata = table_product_imgs::where('product_id', $request->id)->delete();
        }
        if ($productdeletepath) {
          $imagePath = storage_path('app/public/' . $productdeletepath->image);
          $imagePathpub = public_path('public/' . $productdeletepath->image);
          // ইমেজ ফাইল এক্সিস্ট করে কি না চেক করে ডিলিট করুন
            File::delete($imagePath);
            File::delete($imagePathpub);
            $deteletdata = product::where('id', $request->id)->delete();
            return response()->json([
              'status' => true,
              'message'=>'product and image deleted successfully',
              'user' =>$deteletdata,
            ],200);
        } else {
          return response()->json([
              'status' => false,
              'message'=>'product is not found',
          ],404);
        }
      }
    }
 
  //add photo
  public function productAddImg(Request $request){
    $validateImg = Validator::make(
      $request->all(),
      [
        'imgAddId'    => 'required|integer|min:0',
        'myltipulImg' => 'required',
      ]
    );
    
    if ($validateImg->fails()) {
      return response()->json([
        'status' => false,
        'message' => 'Validation Error',
        'errors' => $validateImg->errors()->all(),
      ], 401);
    }else{
      if ($request->hasFile('myltipulImg')) {
        foreach ($request->file('myltipulImg') as $file) {
          // Validate each file
          $validateFile = Validator::make(
            ['file' => $file],
            [
              'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:20480', // 20MB
            ]
          );
          if ($validateFile->fails()) {
            return response()->json([
              'status' => false,
              'message' => 'Validation Error on File',
              'errors' => $validateFile->errors()->all(),
            ], 401);
          }
          // Store file
          $path = $file->store('product-img', 'public');
          // Insert into database
          table_product_imgs::create([
            'product_id' => $request->imgAddId,
            'images' => $path,
          ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Images uploaded successfully!',
        ], 200);
      } else {
        return response()->json([
          'status' => false,
          'message' => 'No file uploaded.',
        ], 400);
      }
    }
  }
  
  //Fetch prodect img 
  public function imgIndex(request $request){
    $validate =validator::make(
      $request->all(),
        [
          'productId' => 'required',
        ]
    );
    if($validate->fails()){
      return response()->json([
        'ststus' => false,
        'message'=>'Validation Error Is',
        'errors' =>$validate->errors()->all(),
      ],401);
    }else{
      $product_img =
      table_product_imgs::where('product_id',$request->productId)->get();
      return response()->json([
        'products_img'   => $product_img,
      ]);
    }
  }
  //delete product img section
    
  public function imagesDelete(request $request){
    $validateUser =validator::make(
      $request->all(),
        [
          'imgId'  => 'required|integer',
        ]
    );
    if($validateUser->fails()){
      return response()->json([
        'ststus' => false,
        'message'=>'Validation Error Is',
        'errors' =>$validateUser->errors()->all(),
      ],401);
    }else{
      $pImgpath = table_product_imgs::where('id', $request->imgId)->first();
      if ($pImgpath) {
        $imagePath = storage_path('app/public/' . $pImgpath->images);
        $imagePathpub = public_path('public/' . $pImgpath->images);
        // ইমেজ ফাইল এক্সিস্ট করে কি না চেক করে ডিলিট করুন
         $deteletdata = table_product_imgs::where('id', $request->imgId)->delete();
          File::delete($imagePath);
          File::delete($imagePathpub);
          
          return response()->json([
            'status' => true,
            'message'=>'product and image deleted successfully',
            'user' =>$deteletdata,
          ],200);
      } else {
        return response()->json([
            'status' => false,
            'message'=>'product is not found',
        ],404);
      }
    }
  }
  //end delete product img
    
  // product_detels section
  public function admin_product_detels(request $request){
    $validateUser =Validator::make(
      $request->all(),
        [
          'product_detels_Id'  => 'required|integer',
        ]
    );
    if($validateUser->fails()){
      return response()->json([
        'ststus' => false,
        'message'=>'Validation Error Is',
        'errors' =>$validateUser->errors()->all(),
      ],401);
    }else{
      
      $products           = product::where('id', $request->product_detels_Id)->first();
      $table_product_imgs = table_product_imgs::where('product_id', $request->product_detels_Id)->all();
      
      $subcategory_product = category_product::where('product_id', $request->product_detels_Id)->get();

      $subcategory_id = $subcategory_product->pluck('subcategory_id');
      
      $subcategory = product_subcategories::whereIn('id', $subcategory_id )->all();
        
      if($products){
        return response()->json([
          'products'   => $products,
          'subcategory' => $subcategory,
          'product_img'=> $table_product_imgs,
        ]);
      }else{
        return response()->json([
          'status' => false,
          'message'=>'product is not found',
        ],404);
      }
    }
  }
    
  //product fetch for category 
  public function Fetch_subcategory_product(request $request){
    $validateUser =Validator::make(
      $request->all(),
        [
          'Fcatagoryid'  => 'required|integer',
        ]
    );
    if($validateUser->fails()){
      return response()->json([
        'ststus' => false,
        'message'=>'Validation Error Is',
        'errors' =>$validateUser->errors()->all(),
      ],401);
    }else{
      $category     =  product_subcategories::where('id', $request->Fcatagoryid)->first();
      $subcategory  =  product_subcategories::where('id', $request->Fcatagoryid)->first();
      $categoryId = $request->Fcatagoryid;
      $products = DB::table('products as p')->join('category_product as pc', 'pc.product_id', '=', 'p.id')->where('pc.subcategory_id', $categoryId)->select('p.*')->distinct()->get();
      
      if($products){
        return response()->json([
          'products'   => $products,
          'subcategory'   => $subcategory,
        ]);
      }else{
        return response()->json([
          'status' => false,
          'message'=>'product is not found',
        ],404);
      }
    }
  }
    
  public function show( request $request ) {  
    $product          =product::with(['product_img','product_reviews','crats','order_item'])->where('id',$request->productId)->first();
    $category_product =category_product::with('product_subcategories')->where('product_id',$request->productId)->get();
    $product_reviews=product_reviews::with(['user','product_review_img'])->where('product_id',$request->productId)->orderBy('id','desc')->get();
    return  response()->json([
      'product'          => $product,
      'category_product' => $category_product,
       'product_reviews'  => $product_reviews,
    ]);
  }
}
