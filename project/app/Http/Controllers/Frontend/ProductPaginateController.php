<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use App\Models\Admin\web_logo;
use App\Models\Admin\product;
use App\Models\Admin\categories;
use App\Models\Admin\product_subcategories;
use App\Models\Admin\table_product_imgs;
use App\Models\Admin\category_product;
use App\Models\product_reviews;
use App\Models\users;
use App\Models\user_profile;


class ProductPaginateController extends Controller
{
  public function All_product(){
    
    
    $posts = product::where('status', '1')->paginate(20);
    $productcount = product::where('status', '1')->count();


    $Categoryall = categories::get();
    $subcategoryall = product_subcategories::get();
    $rating = product_reviews::get();
    $weblogo = web_logo::first();
   
    return view('Frontend.All_product', [
      'posts' => $posts,
      'productcount' => $productcount,
      'Categoryall' => $Categoryall,
      'subcategoryall' =>  $subcategoryall,
      'rating'         =>$rating,
      'weblogo'         =>$weblogo,
    ]);
  }
  
  public function subcategory( $category, $slug ){
    $subcategories = product_subcategories::where('slug', $slug)->first();
    $subcategoriesid = $subcategories->id;
    $products = DB::table('products as p')
      ->join('category_product as pc', 'pc.product_id', '=', 'p.id')
      ->where('pc.subcategory_id', $subcategoriesid)
      ->select('p.*')
      ->where('status', '1') // শুধু products টেবিলের সব কলাম
      ->distinct()      // (ঐচ্ছিক) একই প্রডাক্ট বারবার এলে রিমুভ
      ->paginate(20);
    $productscount = $products->count();
    
    
    
    
    $Categoryall = categories::get();
    $subcategoryall = product_subcategories::get();
    $rating = product_reviews::get();
    $weblogo = web_logo::first();
    
    
    return view('Frontend.product_subcategory', [
      'posts' => $products,
      'productcount' => $productscount,
      'subcategories' => $subcategories,
      'Categoryall' => $Categoryall,
      'subcategoryall' =>  $subcategoryall,
      'rating'         =>$rating,
      'weblogo'         =>$weblogo,
    ]);
  }
  
  public function category( $slug ){
    
        $Category = DB::table('categories')->where('slug', $slug)->first();
        
        $Category_id = $Category->id;
        
        $subCategoryIds = DB::table('product_subcategories')->where('category_id', $Category_id)->pluck('id'); 
        
         $products = DB::table('products as p')
        ->join('category_product as pc', 'pc.product_id', '=', 'p.id')
        ->whereIn('pc.subcategory_id', $subCategoryIds)   // ❮— note whereIn
        ->select('p.*')
        ->where('status', '1')
        ->distinct()
        ->paginate(20);
        
        
      $Categoryall = categories::get();
    $subcategoryall = product_subcategories::get();
    $rating = product_reviews::get();
    $weblogo = web_logo::first();
        
    $productscount = $products->count();
    return view('Frontend.category', [
      'posts' => $products,
      'productcount' => $productscount,
      'Category' => $Category,
      'Categoryall' => $Categoryall,
      'subcategoryall' =>  $subcategoryall,
      'rating'         =>$rating,
      'weblogo'         =>$weblogo,
    ]);
  }
  
  //home 
  public function home(){
    
    $products = product::where('status', '1')
    ->inRandomOrder()
    ->limit(10)
    ->get();
    
        
    $Categoryall = categories::get();
    $subcategoryall = product_subcategories::get();
    $rating = product_reviews::get();
    $weblogo = web_logo::first();
      
        
    return view('Frontend.index', [
      'posts'           => $products,
      'Categoryall'     => $Categoryall,
      'subcategoryall'  => $subcategoryall,
      'rating'          => $rating,
      'weblogo'         => $weblogo,
    ]);
  }
  
  public function productdetels( $slug ){
    
    $products = product::where('slug',$slug)->where('status','1')->first();
    
    $productsid = $products->id;
    $productsimg = table_product_imgs::where('product_id',$productsid)->get();
        
        
        
        
      $Categoryall         = categories::get();
      $subcategoryall      = product_subcategories::get();
      $rating              = product_reviews::get();
      $product_review_img  = table_product_imgs::get();
      $users               = users::get();
      $weblogo             = web_logo::first();
      $user_profile        = user_profile::get();
      $Subcategoryid       = category_product::where('product_id',$productsid)->pluck('subcategory_id');
      
      $recomendition = DB::table('products as p')
        ->join('category_product as pc', 'pc.product_id', '=', 'p.id')
        ->whereIn('pc.subcategory_id', $Subcategoryid)   // ❮— note whereIn
        ->select('p.*')
        ->where('status', '1')
        ->distinct()
        ->paginate(8);
      
      
 
    return view('Frontend.product_dateils', [
      'posts'              => $products,
      'productsimg'        => $productsimg,
      'Categoryall'        => $Categoryall,
      'subcategoryall'     => $subcategoryall,
      'rating'             => $rating,
      'users'              => $users,
      'product_review_img' => $product_review_img,
      'weblogo'            => $weblogo,
      'user_profile'       => $user_profile,
      'recomendition'      => $recomendition,
    ]);
  }
  
  
  public function MarketLook(){
    
     //$posts = DB::table('products')
     //   ->orderBy('id') 
      //  ->cursorPaginate(3);
    
    $posts = DB::table('products')->where('status',
    '1')->orderBy('total_sales','desc')->paginate(20);
    
    
    $Todayproduct = DB::table('products')->whereDate('created_at',
    Carbon::today())->where('status',
    '1')->orderBy('id','desc')->paginate(20);
    
    $Todayproductcount = $Todayproduct->count();
    
    
    $productcount = DB::table('products')->where('status', '1')->count();
   // return view('All_product', compact('posts'));
   
   
    $Categoryall = DB::table('categories')->get();
    $subcategoryall = DB::table('product_subcategories')->get();
    $rating = DB::table('product_reviews')->get();
    $weblogo = DB::table('_web_logo')->first();
   
    return view('Frontend.MarketLook', [
      'posts' => $posts,
      'productcount' => $productcount,
      'Categoryall' => $Categoryall,
      'subcategoryall' =>  $subcategoryall,
      'rating'         =>$rating,
      'weblogo'         =>$weblogo,
      'Todayproduct'    =>$Todayproduct,
      'Todayproductcount'=> $Todayproductcount,
    ]);
  }
  
}
