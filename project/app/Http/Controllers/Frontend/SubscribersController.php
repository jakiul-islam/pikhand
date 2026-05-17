<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class SubscribersController extends Controller
{
    public function subscribe(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'subscribe_input'       => 'required|email',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Enter valied email',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
      //delete
        $chack = DB::table('subscribers')
          ->where('email',$request->subscribe_input)
          ->count();
        
        if($chack < 1){
          $user = DB::table('subscribers')->insert([
            'email'           =>$request->subscribe_input,
            'ip'              =>request()->ip(),
            'subscribed_at'   =>now(),
          ]);
        }else{
          return response()->json([
            'status' => false,
            'message' => '⚠️ You have already subscribed.',
          ], 200);
        }
        
        return response()->json([
          'status' => true,
          'message' => 'subscribed successfull'
        ], 200);
        
      }
    }
    
}
