<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\order;
use App\Models\User;
use App\Models\user_address;
use App\Models\crats;
use App\Models\vouches;
use App\Models\voucher_usages;
use App\Models\payments;
use App\Models\Admin\product;
use App\Models\order_item;

class OrderController extends Controller
{
    public function fetchorderItem(Request $request){
      $userid = session('user_id');
      $user  = User::where('id', $userid)->first();
      $user_address  = user_address::where('user_id',$userid)->first();
      $chackoutproducts  =crats::where('user_id',$userid)->where('status','Ordered')->orderBy('id','desc')->get();
     
      $orderitemcount  = $chackoutproducts->count();
      $productIds = $chackoutproducts->pluck('product_id');
     

      $products = product::whereIn('id', $productIds)->get();
      
      
      $voucher_chack = voucher_usages::where('user_id',$userid) ->where('status', 'applied')->first();
      
      
      if($voucher_chack){
        $voucher_id = $voucher_chack->voucher_id;
        $voucher_show = vouches::where('id',$voucher_id)->where('is_active', '1')->first();
        $voucher_status = true;
      }else{
        $voucher_show = '0';
        $voucher_status = false;
      }
      
      

      
      return response()->json([
        'chackoutproducts'   =>  $chackoutproducts,
        'product'            =>  $products,
        'user'               =>  $user,
        'user_address'       =>  $user_address,
        'orderitemcount'     =>  $orderitemcount,
        'voucher_show'       =>  $voucher_show,
        'voucher_status'     =>  $voucher_status,
      ]);
    }
    
    //plass order section 
    public function plassorder(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'address'                    => 'required|string',
            'Soping_cost'                => 'required|numeric',
            'total_pricehid'             => 'required|numeric',
            'Soping_costtotal_pricehid'  => 'required|numeric',
          ]
      );
        
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
          
        $userid = session('user_id');
        $fetchorder  = order::where('user_id', $userid)->where('status','pending')->get();
        
        $chack   = $fetchorder->count();
        if($chack >= 1 ){
          $orderId = $fetchorder->first()->id;
          $updeteorder = order::where('user_id',$userid)->first();
          $updeteorder->update([
            'subtotal'        =>$request->total_pricehid,
            'discount'        =>'40',
            'shipping_cost'   =>$request->Soping_cost,
            'total'           =>$request->Soping_costtotal_pricehid,
            'status'          =>'pending',
            'shipping_address_id'=>$request->address,
            'updated_at'      => now(),
          ]);
          
        }else{
          $orderId = order::create([
            'order_number'    =>rand(10000, 99999),
            'user_id'         =>$userid,
            'subtotal'        =>$request->total_pricehid,
            'discount'        =>'40',
            'shipping_cost'   =>$request->Soping_cost,
            'total'           =>$request->Soping_costtotal_pricehid,
            'status'          =>'pending',
            'delivery_address_id' =>$request->address,
            'order_address_id' =>$request->address,
            'created_at'      => now(),
            'updated_at'      => now(),
          ])->id;
        }
          
        $products = crats::where('user_id',$userid)->where('status','Ordered')->get();
        $deleteOrder_chack =order_item::where('user_id' ,$userid)->where('method', 'pending')->count();
        if($deleteOrder_chack > 0){
          $deleteOrder_item =  order_item::where('user_id' , $userid)->where('method', 'pending')->delete();
        }
          
        $orderData = [];
        foreach ( $products as $productrow ){
          $cratsproducts  = product::where( 'id',$productrow->product_id)->first();
          $productdis12  = $cratsproducts->discount ;
          $total_price = $productrow->product_price * $productrow->quantity;
          
          $orderData[] = [
            'user_id'      => $userid,
            'product_id'   => (int) $productrow->product_id,
            'quantity'     => (int) $productrow->quantity,
            'unit_price'   => (float) $productrow->product_price,
            'total_price'  => (float) $total_price , // অথবা প্রয়োজন অনুযায়ী
            'discount'     => (float) $productdis12,
            'order_id'     => $orderId,
            'method'       => 'pending',

          ];
        }
            
        $insertOrder_item =  order_item::insert($orderData);
        
        return response()->json([
          'ststus' => true,
          'message'=>'insert img Successfull',
        ],200);
      }
    }
    
    public function index(Request $request){
      $userid = session('user_id');

      $fetch_order_table  = order::where('user_id', $userid)->where('status', 'pending' )->first();
      
      $user_address_id = $fetch_order_table->delivery_address_id;
      
      $user_address   = user_address::where('id', $user_address_id)->first();
      
      
      return response()->json([
        //'chackoutproducts'   => $chackoutproducts,
       // 'product'            => $products,
        //'user'               => $user,
        'user_address'       =>$user_address,
        'fetch_order_table'  =>$fetch_order_table,
      ]);
    }
    
    //confirm order
    
    public function cashondelivery(request $request){
        $validateUser =validator::make(
          $request->all(),
            [
              'order_id'                  => 'required',
              'order_total'               => 'required',
            ]
        );
        
        if($validateUser->fails()){
          return response()->json([
            'ststus' => false,
            'message'=>'Validation Error Is',
            'errors' =>$validateUser->errors()->all(),
          ],401);
        }else{
          $userid = session('user_id');
            $chack = payments::where('order_id', $request->order_id)->where('user_id', $userid )->first();
            
            if(!$chack){
            
              $insertorder = payments::create([
                'user_id'       =>$userid,
                'order_id'      =>$request->order_id,
                'amount'        =>$request->order_total,
                'currency'      =>'bdt',
                'method'        =>'cash_on_delivery',
                'status'        =>'paid',

              ]);
            
            }else{
              
              $insertorder = payments::where('order_id',$request->order_id)->where('user_id', $userid )->first();
              $insertorder->update([
                'user_id'       =>$userid,
                'order_id'      =>$request->order_id,
                'amount'        =>$request->order_total,
                'currency'      =>'bdt',
                'method'        =>'cash_on_delivery',
                'status'        =>'paid',

              ]);
            }
            
            
            
              order::where('user_id',$userid)->where('status','pending')->update([
               'status'          =>'processing',
              ]);
              
              crats::where('user_id',$userid)->where('status','Ordered')->update([
                'status'          =>'Shipped',
              ]);
            
          $fetchorder_item = order_item::where('order_id',$request->order_id)->where('method','pending')->get();
            
            foreach ($fetchorder_item as $fetchorder_item_row ){
              $products_id = $fetchorder_item_row->product_id;
              $products_order_quantity= $fetchorder_item_row->quantity;
              
              $product_fetch = product::where('id',$products_id)->first();
              $product_quantity = $product_fetch->stock;
              
              $math = $product_quantity - $products_order_quantity;
              
               product::where('id',$products_id)->update([
               'stock'          => $math ,
              ]);
            }
            
            order_item::where('user_id',$userid)->where('method','pending')->update([
              'method'          =>'processing',
            ]);
            
            
            return response()->json([
              'ststus' => true,
              'message'=>'Order placed successfully',
              //'user' =>$user,
            ],200);
        }
    }
    
    //fetch confirm order
    public function userOrderInfo(Request $request){
      $userid = session('user_id');
    
      $products = product::where('name', 'like', '%' . $request->searchinput . '%')->orderBy('id', 'desc')->get();
       
        $productIds = $products->pluck('id')->toArray();

        $chackoutproducts = order_item::where('user_id', $userid)
            ->whereIn('product_id', $productIds)
            ->orderBy('id','desc')
            ->get();
       
     
     
      $fetch_order_table  = order::where('user_id', $userid)->first();
      
      $fetch_order_id = $fetch_order_table->id;
      
      $successorderItem = order_item::where('order_id', $fetch_order_id)
        ->orderBy('id','desc')
        ->get();
      
      
      return response()->json([
        'successorderItem'   => $successorderItem,
        'chackoutproducts'   => $chackoutproducts,
        'product'            => $products,
        'fetch_order_table'  => $fetch_order_table,
      ]);
    }
 
    
}
