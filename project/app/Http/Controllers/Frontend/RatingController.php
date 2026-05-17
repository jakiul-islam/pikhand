<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\product;
use App\Models\product_reviews;
use App\Models\product_review_img;
use App\Models\Admin\categories;
use App\Models\Admin\product_subcategories;

class RatingController extends Controller
{
  public function productdetels( $slug ){
    $products       = product::where('slug',$slug)->where('status','1')->first();
    $productsid     = $products->id;
    $userid         = session('user');
    $productsimg    = product_review_img::where('product_id',$productsid)->get();
    $Categoryall    = categories::all();
    $subcategoryall = product_subcategories::all();
    
    $reviews = product_reviews::where('product_id',$productsid)->where('user_id',$userid)->first();
    
    $allReviews = product_reviews::where('product_id',$productsid)->get();
    
    
    
    return view('Frontend.product_ratting', [
      'posts'          => $products,
      'productsimg'    => $productsimg,
      'Categoryall'    => $Categoryall,
      'subcategoryall' => $subcategoryall,
      'reviews'        => $reviews,
      'allReviews'     => $allReviews
    ]);
    
  }
  //create rating section
  public function create(Request $request){
    $validateUser = Validator::make(
      $request->all(),
      [
        'showstarinput' => 'required|integer|min:0',
        'ProductId' => 'required|integer|min:0',
        'Rattingtextarea' => 'string',
      ]
    );

    if ($validateUser->fails()) {
      return response()->json([
        'status' => false,
        'message' => 'Validation Error',
        'errors' => $validateUser->errors()->all(),
      ], 401);
    }else{
    
      $userid = session('user');
      $ProductId = $request->ProductId;
    
      $ratingchack = product_reviews::where('user_id' , $userid )->where('product_id',$ProductId)->count();
      
      $rating = product_reviews::where('user_id' , $userid)->where('product_id',$ProductId)->first();
      
      if( $ratingchack < 1){
        
        
        
        $ratingid = product_reviews::create([
          'user_id'      =>$userid,
          'product_id'   =>$request->ProductId,
          'rating'       =>$request->showstarinput,
          'review'       =>$request->Rattingtextarea,
        ])->id;
        
        if($ratingid > 0){
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
                }else{
    
                // Store file
                  $path = $file->store('ratting_images', 'public');
    
                // Insert into database
                  $insertImg  = product_review_img::create([
                    'reviews_id' => $ratingid,
                    'user_id'    => $userid,
                    'product_id' => $request->ProductId,
                    'img'        => $path,

                  ]);
                }
            }
          }
        }
        
        return response()->json([
          'status'  => true,
          'massege' => 'thanks for your reviews',
        ], 200);
        
      }else{
        
        $ratingidForUpdate = $rating->id;
      
        $ratingupdate = product_reviews::where('user_id',$userid)->where('product_id',$ProductId)->first();
        $ratingupdate->update([
          'rating'       =>$request->showstarinput,
          'review'       =>$request->Rattingtextarea,
        ]);
        
        
        $Fetch_review_img =  product_review_img::where('user_id',$userid)->where('product_id',$ProductId)->get();
        
        foreach($Fetch_review_img as $row_img){
          $image = storage_path('app/public/' . $row_img->img);
          $imagepub = public_path('public/' . $row_img->img);
          File::delete($image);
          File::delete($imagepub);
        }
        
          
        if ($request->hasFile('myltipulImg')) {
          
          $Fetch_review_img =   product_review_img::where('user_id',$userid)->where('product_id',$ProductId)->delete();
          
          
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
            }else{
              // Store file
              $path = $file->store('ratting_images', 'public');
              // Insert into database
                $insertImg  = product_review_img::create([
                    'reviews_id' => $ratingidForUpdate,
                    'user_id'    => $userid,
                    'product_id' => $ProductId,
                    'img'        => $path,
                  ]);
            }
          }
        }
        
        
        return response()->json([
          'status'  => true,
          'message' => 'your review and rating update success',
        ], 200);
        
      }
    }
  }
  
  
  public function index(Request $request){
    $validateUser = Validator::make(
        $request->all(),
        [
            'ProductId' => 'required|integer|min:0',
        ]
    );

    if ($validateUser->fails()) {
      return response()->json([
        'status' => false,
        'message' => 'Validation Error',
        'errors' => $validateUser->errors()->all(),
      ], 401);
    }else{
      $userid      = session('user');
      $product     =  product::where('id',$request->ProductId)->first();
      $rating      =  product_reviews::where('user_id',$userid)->where('product_id',$request->ProductId)->first();
      $ratingcount =  product_reviews::where('user_id',$userid)->where('product_id',$request->ProductId)->count();
      $rating_img  =  product_review_img::where('user_id',$userid)->where('product_id',$request->ProductId)->get();
      $userProfile =  DB::table('user_profile')->get();
      $user        =  DB::table('users')->get();
      $Allrating   =  product_reviews::where('product_id',$request->ProductId)->get();
      $Allratingcount   =  $Allrating->count();

      
      return response()->json([
        'status'      => true,
        'product'     => $product,
        'rating'      => $rating,
        'rating_img'  => $rating_img,
        'userProfile' => $userProfile,
        'Allrating'   => $Allrating,
        'user'        => $user,
        'Allratingcount' => $Allratingcount,
        'ratingcount'  => $ratingcount,
      ], 200);

    }
  }
  
  
}
