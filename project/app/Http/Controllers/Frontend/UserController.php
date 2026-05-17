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



class UserController extends Controller
{
   
    // insert user address
    public function createAddress(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'name'  => 'required|string',
            'phone'  => 'required|numeric',
            'a1'  => 'required|string',
            'home_office'  => 'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Please enter a valid phone number',
        ],401);
      }else{
          
          $userid = session('user_id');
          
          $user = user_address::insert([
            'user_id'      =>$userid,
            'phone_number' =>$request->phone,
            'address'      =>$request->a1,
            'name'         =>$request->name,
            'propoler_name'=>'jakiul islame',
            'home_office'  => $request->home_office,
            'created_at'   => now(),
            'updated_at'   => now(),
          ]);
          
          return response()->json([
            'status' => true,
            'message'=>'insert img Successfull',
             'user' =>'insert Successfull',
          ],200);
      }
    }
    //fetch address 
    public function indexAddress(request $request){
      
      $userid = session('user_id');
        
        $user_address = user_address::where('user_id', $userid )->get();  
        
      return response()->json([
        'status'       => true,
        'user_address' =>$user_address,
      ],200);
    }
    //address delete section
    public function deleteAddress(request $request){
        $validateUser =validator::make(
          $request->all(),
            [
              'addressId'  => 'required',
            ]
        );
        if($validateUser->fails()){
          return response()->json([
            'status' => false,
            'message'=>'Please enter a valid phone number',
          ],401);
        }else{
            
            $userid = session('user_id');
            
            $deteletdata = user_address::where('id', $request->addressId)->where('user_id', $userid)->delete();
            
            return response()->json([
              'status' => true,
              'message'=>'insert img Successfull',
               'user' =>'insert Successfull',
            ],200);
        }
      }  
    // Forgotpassword
    
}
