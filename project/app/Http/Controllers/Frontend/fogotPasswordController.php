<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\user_address;


class fogotPasswordController extends Controller
{
    public function phonenumberChack(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'forgotphone' => 'required',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Please enter a valid phone number',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
       
        $usercount = user::where('phone_number',  $request->forgotphone)->count();  
        if ($usercount > 0) {
          $forgotreotp = rand(100000,999999);
          
          $user = user::where('phone_number',$request->forgotphone)->update([
            'otp' => $forgotreotp ,
          ]);
          

          return response()->json([
            'status' => true,
            'number'=>$request->forgotphone,
          ],200);
           
           
        }else{
          return response()->json([
            'status' => false,
            'message'=>'phone number does not match',
          ],401);
        }
      }
    }
    //insert new password
    public function insertnewpassword(request $request){
        $validateUser =validator::make(
          $request->all(),
            [
              'phoneInput' => 'required',
              'password'   => 'required|string',
            ]
        );
        if($validateUser->fails()){
          return response()->json([
            'status' => false,
            'message'=>'Please enter a valid phone number',
            'errors' =>$validateUser->errors()->all(),
          ],401);
        }else{
          
          $password = $request->password;
          
          $hashedPassword = Hash::make($password);
          
          $countProduct = user::where('phone_number',$request->phoneInput)->where('status', 1)->count();
        
          if($countProduct > 0){
            user::where('phone_number',$request->phoneInput)->update([
              'password' =>$hashedPassword,
              'updated_at'   => now(),
            ]);
            
            return response()->json([
              'status' => true,
              'message'=>'user sign in Successfull',
              'number' => 'user sign in Successfull',
            ],200);
          }else{
            return response()->json([
              'status' => false,
             // 'message'=>$countProduct,
              'message'=>'user sign in not Successfull',
            ],401);
          }
        }
      }
  
}
