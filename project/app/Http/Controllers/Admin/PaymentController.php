<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


use App\Models\payments;
use App\Models\order;
use App\Models\order_item;
use App\Models\User;
use App\Models\user_address;


class PaymentController extends Controller
{
    public function index(request $request){

      $query = payments::with('user', 'order')->orderBy('id', 'desc' );
    
      if($request->select != 'All'){
        $query->where('status', $request->select);
      }
      
      if($request->selectMethod != 'All'){
        $query->where('method', $request->selectMethod);
      }
      
      
      if($request->time){
          $time = Carbon::parse($request->time)->format('Y-m-d H:i:s');
          $query->where('created_at', '>', $time);
        }
    
      if($request->search_input){
        $query->where('amount', 'like', '%'.$request->search_input.'%')
          ->orWhereHas('user', function($q) use ($request) {
            $q->where('name', 'like', '%'.$request->search_input.'%')
            ->orWhere('phone_number', 'like', '%'.$request->search_input.'%');
          });
      }
      

      $payments = $query->paginate(10);
      
      
      
      
      return response()->json([
        'status' => true,
        'payments'=>$payments,
      ],200);
    }
    
    public function details(request $request){
      
      $PaymentId = $request->Paymentid;
      $Payment = payments::where('id', $PaymentId )->first();
      
      $userId = $Payment->user_id;
      $orderId = $Payment->order_id;
      
      $user        = User::where('id', $userId )->first();
      $order       = order::where('id', $orderId )->first();
      $orderItem   = order_item::with('product')->where('order_id', $orderId )->get();
      
      $useraddress = user_address::where('user_id', $userId )->first();

      

      return response()->json([
        'status'      => true,
        'Payment'     => $Payment,
        'user'        => $user,
        'order'       => $order,
        'orderItem'   => $orderItem,
        'useraddress' => $useraddress,
      ],200);
      
    }
      
      
      
    public function PaymentOrderItem(request $request){
      
      $order_id = $request->order_id;

      $order_item = order_item::with('product')
        ->where('order_id',$order_id)
        ->orderBy('order_item_id','desc')
        ->get();
        
      
      return response()->json([
        'status'       => true,
        'order_item'   => $order_item,
      ],200);
      
    }
}
