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
use App\Models\order_item;
use App\Models\order;
use App\Models\Admin\notification;


class OrderController extends Controller{
  
  public function index(Request $request){
    $query = Order::with(['user','payments'])->orderBy('id', 'desc' );
    
    if($request->select != 'All'){
      $query->where('status', $request->select);
    }
    if($request->time){
      $time = Carbon::parse($request->time)->format('Y-m-d H:i:s');
      $query->where('created_at', '>', $time);
    }
    
    if($request->search_input){
      $query->where('order_number', 'like', '%'.$request->search_input.'%')
        ->orWhereHas('user', function($q) use ($request) {
          $q->where('name', 'like', '%'.$request->search_input.'%')
          ->orWhere('phone_number', 'like', '%'.$request->search_input.'%');
        });
    }
    
    $orders = $query->paginate(10);
      
    return response()->json([
      'orders' => $orders,
    ]);
  }
  
  public function OrderStatusUpdate(Request $request){
    $validate =Validator::make(
      $request->all(),
        [   
          'orderId'     => 'required|exists:orders,id',
          'orderStatus' => 'required|string',
        ]
      );
      if($validate->fails()){
        return response()->json([
          'status' => false,
          'errors'=>'Validation Error , try again',
        ],401);
      }
    
    //try {
        $order = order::findOrFail($request->orderId);
        
        $orderUpdate = $order->update([
            'status' => $request->orderStatus,
        ]);
        
        $order_item = order_item::where('order_id',$request->orderId)->update([
          'method' => $request->orderStatus,
        ]);
        
        $order_status = $request->orderStatus;
        
        $admin = session('admin_uuid');
        $notification = notification::create([
          //'title' => 'Order ' . ucfirst($order_status),
          'title' => 'Order ' .$order_status,
          
          'message' => 'Your order #'.$order->order_number.' has been confirmed and is being processed.',
          'type' => 'success', // success, info, warning, error
          'icon' => 'fa-check-circle', // FontAwesome icon
          'url' => '/user/orders/'.$order->id, // ইউজার ক্লিক করলে কোথায় যাবে
          'user_id' => $order->user_id, // যার অর্ডার তাকে পাঠাবো
          'created_by' =>$admin, // কোন এডমিন কনফার্ম করলো
          'read_at' => null, 
        ]);
        
        
        if($orderUpdate){
            return response()->json([
                'status' => true,
                'message'=> 'Update successful'
            ], 200);
        } else {
          return response()->json([
            'status' => false,
            'message'=> 'Update failed, try again',
          ], 200);
        }
   /* } catch (\Exception $e) {
      return response()->json([
        'status' => false,
        'message'=> 'Update failed, try again',
      ], 200);
    }*/
  }
  
  
  public function OrderDeteils(Request $request){
    $validate =Validator::make(
      $request->all(),
        [   
          'orderId'     => 'required|exists:orders,id',
        ]
      );
    if($validate->fails()){
      return response()->json([
        'status' => false,
        'errors'=>'Validation Error , try again',
      ],401);
    }else{
      
      $order = order::with(['User', 'payments', 'order_item', 'order_address',
      'delivery_address'])
      ->find($request->orderId);
      
      
      $order_item = order_item::with('product')->where('order_id',$order->id)->get();
      
      
      return response()->json([
        'status' => true,
        'order'=>$order,
        'order_item' => $order_item
      ],200);
      
    }
  }

}
