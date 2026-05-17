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

class UserProfileController extends Controller
{
  public function create(request $request){
    $validateUser =Validator::make(
      $request->all(),
        [
          'profile_input' => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
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
      $userid = session('user');
      
      $chack = DB::table('user_profile')->where('user_id',$userid)->count();
      
        if($chack < 1){
          $path = $request->file('profile_input')->store('user_profile', 'public');
          $user = DB::table('user_profile')->insert([
            'user_id'=>$userid,
            'profile_picture' => $path,
          ]);
        }else{
          $path = $request->file('profile_input')->store('user_profile', 'public');
          $profile= DB::table('user_profile')->where('user_id',$userid)->first();
          $editeimagePath = storage_path('app/public/' . $profile->profile_picture);
          $editeimagePathpub = public_path('public/' . $profile->profile_picture);
          File::delete($editeimagePath);
          File::delete($editeimagePathpub);
          
          $user = DB::table('user_profile')->where('user_id',$userid)->update([
            'profile_picture' => $path,
          ]);
          
          
        }
      return response()->json([
        'ststus' => true,
        'message'=>'insert img Successfull',
        'path' =>$path,
      ],200);
    }
  }
  
  // fetch user profile
  public function profile_fetch(){
    $userid = session('user');
    $profile= DB::table('user_profile')->where('user_id',$userid)->first();
    $User= DB::table('users')->where('id',$userid)->first();
    
    return response()->json([
      'User'     => $User,
      'profile'  => $profile,
    ],200);
  }
  
  public function createInfo(request $request){
    $validateUser =validator::make(
      $request->all(),
        [
          'nameInput' => 'required|string',
          'timeInput' => 'required|string',
          'genderInput' => 'required|string',
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
        $userid = session('user');
            $user = DB::table('users')->where('id',$userid)->update([
              'name' =>$request->nameInput,
            ]);
          $chack = DB::table('user_profile')->where('user_id',$userid)->count();
      
          if($chack < 1){
            $user = DB::table('user_profile')->insert([
              'user_id'        =>$userid,
              'date_of_birth'  =>$request->timeInput,
              'gender'         => $request->genderInput,
              'created_at'   => now(),
              'updated_at'   => now(),
            ]);
          }else{
            
            $user = DB::table('user_profile')->where('user_id',$userid)->update([
              'date_of_birth'  =>$request->timeInput,
              'gender'         => $request->genderInput,
              'updated_at'   => now(),
            ]);
          }
        return response()->json([
          'ststus' => true,
          'message'=>'insert img Successfull',
        ],200);
      }
  }
  // fetch info 
  public function indexInfo(){
    $userid = session('user');
    $name= DB::table('users')->where('id',$userid)->first();
    $namecount= DB::table('users')->where('id',$userid)->count();
    $profile= DB::table('user_profile')->where('user_id',$userid)->first();
    $profilecount= DB::table('user_profile')->where('user_id',$userid)->count();
    return response()->json([
      'name'     => $name,
      'namecount'  => $namecount,
      'profile'  => $profile,
      'profilecount'  => $profilecount,

    ],200);
  }
  
  // chack user password for change
  public function chackpasswordforchang(request $request){
    $validateUser =validator::make(
      $request->all(),
        [
          'userchangepassword' => 'required|string',
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
        $userid = session('user');
            
          $chack = DB::table('users')->where('id',$userid)->first();
      
          if( $chack && Hash::check($request->userchangepassword, $chack->password)){
            return response()->json([
              'ststus' => true,
              'message'=>'insert img Successfull',
            ],200);
          }else{
            return response()->json([
              'ststus' => false,
              'message'=>'Validation Error Is',
              'errors' =>$validateUser->errors()->all(),
            ],401);
          }
      }
  }
  //chang new password
  public function setnewpassword(request $request){
    $validateUser =validator::make(
      $request->all(),
        [
          'newpassword' => 'required|string',
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
        $userid = session('user');
        $chack = DB::table('users')->where('id',$userid)->first();
        
        $password_hash = Hash::make($request->newpassword);
        
        $user = DB::table('users')->where('id',$userid)->update([
          'password' =>$password_hash,
        ]);
          
      }
  }
}
