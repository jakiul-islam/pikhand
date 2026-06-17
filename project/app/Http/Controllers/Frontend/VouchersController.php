<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class VouchersController extends Controller
{
    public function InsertVoucher(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
              'voucherCode'  => 'required|string|max:50',
              'VouchersType' => 'required|string',
              'voucherAnount'=> 'required|numeric',
              'minprice'     => 'required|numeric',
              'usage_limit'  => 'required|integer',
              'start_at'     => 'required|date',
              'end_at'       => 'required|date|after_or_equal:start_at',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $user = DB::table('vouches')->insert([
          'code'            =>$request->voucherCode,
          'type'            =>$request->VouchersType,
          'amount'          =>$request->voucherAnount,
          'min_order_amount'=>$request->minprice,
          'usage_limit'     =>$request->usage_limit,
          'starts_at'       =>$request->start_at,
          'ends_at'         =>$request->end_at,
          'created_at'      =>now(),
          'updated_at'      =>now(),
        ]);
        return response()->json([
          'ststus' => true,
          'message'=>'insert img Successfull',
           'user' =>$user,
        ],200);
      }
    }
    //fetch brands
    public function Fetchvoucher(){
        $vouches = DB::table('vouches')->get();
        return response()->json($vouches);
    }
    //eidte brands 
    public function edite_voucher(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
              'edit_voucherid'  => 'required|string|max:50',
              'edit_voucherCode'  => 'required|string|max:50',
              'edit_VouchersType' => 'required|string',
              'edit_voucherAnount'=> 'required|numeric',
              'edit_minprice'     => 'required|numeric',
              'edit_usage_limit'  => 'required|integer',
              'edit_start_at'     => 'required|date',
              'edit_end_at'       => 'required|date|after_or_equal:start_at',
          ]
        );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=> "Validation errors is",
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $user = DB::table('vouches')->where('id',$request->edit_voucherid)->update([
          'code'            =>$request->edit_voucherCode,
          'type'            =>$request->edit_VouchersType,
          'amount'          =>$request->edit_voucherAnount,
          'min_order_amount'=>$request->edit_minprice,
          'usage_limit'     =>$request->edit_usage_limit,
          'starts_at'       =>$request->edit_start_at,
          'ends_at'         =>$request->edit_end_at,
          'updated_at'      =>now(),
        ]);
        return response()->json([
          'ststus' => true,
          'message'=>'insert img Successfull',
          'user' =>$user,
        ],200);
      }
    }
    
    //end edite brand 
    //delete brand
    public function deletevoucher(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'voicherid'  => 'required|integer',
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
        $brand_delete = DB::table('vouches')->where('id',  $request->voicherid)->delete();
         
        return response()->json([
          'status' => true,
          'message'=>'Category not found',
        ],200);
      }
    }
    
    //voucher chack
    
    public function chack(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'Apply_voucher'       => 'required|string',
            'showPriceForVoucher' =>'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'right your voucher code',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
      //delete
        $get_voucher = DB::table('vouches')
        ->where('code',$request->Apply_voucher)
        ->where('is_active', '1')
        ->first();
        
        
        if (!$get_voucher) {
          return response()->json([
            'status' => false,
            'result' => '⚠️ Invalid voucher code!'
          ], 200);
        }
        // 1️⃣ Minimum order amount চেক
        if ($request->showPriceForVoucher < $get_voucher->min_order_amount) {
          return response()->json([
            'status' => false,
            'result' => '⚠️ Your order amount is insufficient to apply the voucher.'
          ], 200);
        }
         // 2️⃣ Voucher start date চেক
        $now = now();

        if (Carbon::parse($get_voucher->starts_at)->greaterThan($now)) {
          return response()->json([
            'status' => false,
            'result' => '⚠️ This voucher code is not active yet!'
          ], 200);
        }
        
        // 3️⃣ Voucher end date চেক
        if (Carbon::parse($get_voucher->ends_at)->lessThan($now)) {
          return response()->json([
            'status' => false,
            'result' => '⚠️ This voucher code has expired!'
          ], 200);
        }
        // 4️⃣ Usage limit চেক
        if ($get_voucher->used_count >= $get_voucher->usage_limit) {
          return response()->json([
            'status' => false,
            'result' => '⚠️ This voucher code usage limit has been reached!'
          ], 200);
        }
        
        $userid = session('user_id');
        
        $chack = DB::table('voucher_usages')
                ->where('user_id',$userid)
                ->where('voucher_id',$get_voucher->id)
                ->count();
        
        if($chack < 1){
          $user = DB::table('voucher_usages')->insert([
            'user_id'         =>$userid,
            'voucher_id'      =>$get_voucher->id,
            //'order_id'        =>$request->voucherAnount,
            'used_at'         =>now(),
            'created_at'      =>now(),
            'updated_at'      =>now(),
          ]);
        }else{
          return response()->json([
            'status' => false,
            'result' => '⚠️ You have already used this voucher.',
          ], 200);
        }
        
        return response()->json([
          'status' => true,
          'result' => $get_voucher
        ], 200);
        
      }
    }
    
   
    
}
