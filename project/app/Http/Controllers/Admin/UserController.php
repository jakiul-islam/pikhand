<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

use App\Models\User;
use App\Models\order;
use App\Models\order_item;
use App\Models\user_address;
use App\Models\crats;
use App\Models\product_reviews;
use App\Models\feedback;
use App\Models\payments;
use App\Models\product_review_img;


class UserController extends Controller
{
    public function index(request $request){

      $query = User::orderBy('Login_time', 'desc' );
    
      if($request->select != 'All'){
        $query->where('status', $request->select);
      }
      
      /*if($request->selectcountry != 'All'){
        $query->where('country', $request->selectcountry);
      }*/
      
      
     if($request->time){
        $time = Carbon::parse($request->time)->format('Y-m-d H:i:s');
        $query->where('created_at', '>', $time);
      }
    
      if($request->search_input){
        $query->where(function($q) use ($request) {
          $q->where('name', 'like', '%'.$request->search_input.'%')
            ->orWhere('phone_number', 'like', '%'.$request->search_input.'%');
        });
      }
      

      $users = $query->paginate(10);
      
      return response()->json([
        'ststus' => true,
        'users'=>$users,
      ],200);
    }

    public function useractiveUnactiv(request $request){
      $userid = $request->userid;
      $buttonvalue = $request->buttonvalue;
      
      $users = User::where('id', $userid)->first();
      $users->update([
        'status' => $buttonvalue,
      ]);
      
      if($buttonvalue == 0 ){
        $active= 'This user unactive successfull';
      }else{
        $active= 'This user active successfull';
      }
   
      return response()->json([
        'ststus' => true,
        'users'=>$users,
        'message'=>$active,
      ],200);
    }

    public function delails(request $request){
      
      $userid = $request->userid;

      $user = User::where('id',$userid)
        ->first();
        
      $user_address = user_address::where('user_id',$userid)
        ->get();
        
        
      $user_order = order::where('user_id',$userid)
        ->orderBy('id','desc')
        ->get();
      
        $user_order_count = $user_order->count();
        
      
        
        $order_item = order_item::with('product')->where('user_id',$userid)->orderBy('order_item.id','desc')->get();
          
        $pandingOrder = order_item::where('user_id',$userid)
          ->where('method','panding')
          ->get();
          
        $processingOrder = order_item::where('user_id',$userid)
          ->where('method','processing')
          ->get();
        $shippedOrder = order_item::where('user_id',$userid)
          ->where('method','shipped')
          ->get();
        $cancelledOrder = order_item::where('user_id',$userid)
          ->where('method','cancelled')
          ->get();
          
        $completeOrder = order_item::where('user_id',$userid)
          ->where('method','completed')
          ->get();
        $RefoundOrder = order_item::where('user_id',$userid)
          ->where('method','Refound')
          ->get();
        $total_shipping = order::where('user_id',$userid)
          ->get();
        
        
        $total_carts = crats::with('product')->where('user_id',$userid)->get();
        
        
        $total_review = product_reviews::with('product')
          ->where('user_id',$userid)
          ->orderBy('id','desc')
          ->get();
        
        $product_review_img = product_review_img::where('user_id',$userid)->get();
        
        
        
        $total_review_count = $total_review->count();
        
        
        $total_carts_count = $total_carts->count();
        
        $totalOrderItem = $order_item->count();
        
        
        $user_feedback = feedback::where('user_id',$userid)
          ->get();
        
        
        $user_payments = payments::with('order')
          ->where('user_id',$userid)
          ->orderBy('id','desc')
          ->get();
        
        
      return response()->json([
        'status'       => true,
        'user'         => $user,
        'user_address' => $user_address,
        'user_order'   => $user_order,
        'order_item'   => $order_item,
        'pandingOrder' => $pandingOrder,
        'processingOrder' => $processingOrder,
        'shippedOrder' => $shippedOrder,
        'completeOrder' => $completeOrder,
        'RefoundOrder' => $RefoundOrder,
        'cancelledOrder'=> $cancelledOrder,
        'totalOrderItem' => $totalOrderItem,
        'total_shipping' => $total_shipping,
        'user_order_count'=> $user_order_count,
        'total_carts'    => $total_carts,
        'total_carts_count'=> $total_carts_count,
        'total_review'     => $total_review,
        'total_review_count'=> $total_review_count,
        'user_feedback'     => $user_feedback,
        'user_payments'     => $user_payments,
        'product_review_img'=> $product_review_img,
      ],200);
      
    }
      
    public function userOrderItem(request $request){
      
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

}
