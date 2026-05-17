<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\notice;


class NotiseController extends Controller
{
      //insert notise section 
    public function insertnoise(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'notise_name'  => 'required|string',
            'notise_description' => 'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
          // 'dd' => dd(request()->all());
        ],401);
      }else{
        $chack = notice::count();
        if($chack > 0 ){
          $notice = notice::first();
          $notice_insert = $notice->update([
            'title'        =>$request->notise_name,
            'description' =>$request->notise_description,
            'created_by' =>'Admin',
          ]);
        }else{
          $notice_insert = notice::create([
            'title'        =>$request->notise_name,
            'description'  =>$request->notise_description,
            'created_by'   =>'Admin',
          ]);
        }
        
        
        
        return response()->json([
          'ststus' => true,
          'massege'=>' notice update Successfull',
           'notice_insert' =>$notice_insert,
        ],200);
      }
    }
    
    
    //notise fetch 
    public function notisefetch(){
      $notise = notice::first();

      return response()->json([
        'notise'=> $notise,
      ],200);
    }
    
     // switchValue section 
    public function switchValue(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'switchValue'  => 'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
          // 'dd' => dd(request()->all());
        ],401);
      }else{
        $notise = notice::first();
        $notise_update = $notise->update([
          'is_active'             => $request->switchValue ,
        ]);
        
        $noticefetch = notice::first();
        if($request->switchValue > 0 ){
          return response()->json([
            'massege'    => 'Notice active successfull',
            'noticefetch'   => $noticefetch,
          ]);
        }else{
          return response()->json([
            'massege'    => 'Notice unactive successfull',
            'noticefetch'   => $noticefetch,
          ]);
        }
      }
    }
    
    //page switchValue
    
    public function pageswitch(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'switchValue'  => 'required|string',
            'pagename'  => 'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
          // 'dd' => dd(request()->all());
        ],401);
      }else{
        $user = DB::table('page_switch')->update([
          $request->pagename  => $request->switchValue ,
        ]);
        
        $service = DB::table('page_switch')->first();
        return response()->json([
          'service'   => $service,
          ]);
      }
    }
    //fetchpageswitch all of the
    public function fetchpageswitch(request $request){
      
      $page_chack = DB::table('page_switch')->first();
      return response()->json([
        'page_chack'   => $page_chack,
      ]);
      
    }
  
  //page switchValue
    public function paymentpageswitch(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'switchValue'  => 'required|string',
            'payment'  => 'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
          // 'dd' => dd(request()->all());
        ],401);
      }else{
        $user = DB::table('payment_switch')->update([
          $request->payment  => $request->switchValue ,
        ]);
        
        $service = DB::table('payment_switch')->first();
        return response()->json([
          'service'   => $service,
          ]);
      }
    }
    //fetchpageswitch all of the
    public function fetchpaymentpageswitch(request $request){
      
      $payment_switch = DB::table('payment_switch')->first();
      return response()->json([
        'payment_switch'   => $payment_switch,
      ]);
      
    }
  
  
}
