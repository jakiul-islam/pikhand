<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


use App\Models\product_reviews;
use App\Models\User;
use App\Models\product_review_img;
use App\Models\order_item;
use App\Models\Admin\product;


class ReviewController extends Controller
{
  public function index(request $request){
      
    $query = product_reviews::with(['user','product'])->orderBy('id', 'desc' );
    
    if($request->select != 'All'){
      $query->where('rating', $request->select);
    }
    if($request->time){
      $time = Carbon::parse($request->time)->format('Y-m-d H:i:s');
      $query->where('created_at', '>', $time);
    }
    
    /*if($request->search_input){
      $query->orWhereHas('user', function($q) use ($request) {
          $q->where('name', 'like', '%'.$request->search_input.'%')
            ->orWhere('phone_number', 'like', '%'.$request->search_input.'%');
            ->orWhere('product_name', 'like', '%'.$request->search_input.'%');
      });
    }
    */
    if($request->search_input){
      $query->orWhereHas('user', function($q) use ($request) {
          $q->where('name', 'like', '%'.$request->search_input.'%')
            ->orWhere('phone_number', 'like', '%'.$request->search_input.'%');
      })
      ->orWhereHas('product', function($q) use ($request) {
          $q->where('name', 'like', '%'.$request->search_input.'%');
      });
    }

    
    $product_reviews = $query->paginate(10);
      return response()->json([
        'ststus' => true,
        'product_reviews'=>$product_reviews,
      ],200);
  }
    
    public function Reviewdeteils(request $request){
      
      $Reviewsid = $request->Reviewsid;
      
      $product_reviews = product_reviews::where('id',$Reviewsid)
        ->first();
      
      $reviews_user_id = $product_reviews->user_id;
      $reviews_product_id = $product_reviews->product_id;
      
      $product_reviews_count = product_reviews::where('product_id',$reviews_product_id)
        ->count();
      
      $reviews_user = User::where('id',$reviews_user_id)
        ->first();
      
      $reviews_products = product::where('id',$reviews_product_id)
        ->first();
      
      $product_review_img = product_review_img::where('reviews_id',$Reviewsid)
        ->get();
      

      return response()->json([
        'ststus'                   => true,
        'product_reviews'          => $product_reviews,
        'reviews_user'             => $reviews_user,
        'reviews_products'         => $reviews_products,
        'product_reviews_count'    => $product_reviews_count,
        'product_review_img'       => $product_review_img,
      ],200);
      
    }
      
    public function ReviewProduct(request $request){
      
      $order_id = $request->order_id;

      $order_item = order_item::join('products', 'products.id', '=', 'order_item.product_id')
        ->where('order_id',$order_id)
        ->select(
          'order_item.*', 
          'order_item.id as order_item_id', 
          'products.name as products_name',
        )
        ->orderBy('order_item_id','desc')
        ->get();
        
      
      return response()->json([
        'ststus'       => true,
        'order_item'   => $order_item,
      ],200);
      
    }
    
    
  public function editReview(Request $request){
    $validateUser = Validator::make(
      $request->all(),
      [
        'showstarinput' => 'required|integer|min:0',
        'reviewId' => 'required|integer|min:0',
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
    
      $reviewId = $request->reviewId;
    
      $ratingupdate = product_reviews::where('id',$reviewId)->first();
      $ratingupdate->update([
        'rating'       =>$request->showstarinput,
        'review'       =>$request->Rattingtextarea,
        'updated_at'   => now(),
      ]);
        
      return response()->json([
        'status'  => true,
        'massege' => 'your review and rating update success',
      ], 200);
    }
  }
  
  
  public function ReviewImgdelete(Request $request){
    $validateUser = Validator::make(
      $request->all(),
      [
        'reviewId' => 'required|integer|min:0',
      ]
    );

    if ($validateUser->fails()) {
      return response()->json([
        'status' => false,
        'message' => 'Validation Error',
        'errors' => $validateUser->errors()->all(),
      ], 401);
    }else{
    
      $reviewId = $request->reviewId;
    
      $ratingupdate = product_review_img::destroy($reviewId);

      return response()->json([
        'status'  => true,
        'massege' => 'your review and rating update success',
      ], 200);
    }
  }
  
    
}
