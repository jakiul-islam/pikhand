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

class LoginController extends Controller
{
   //loginUser
    public function login(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'email' => 'required|email',
            'password' => 'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Please enter a valid email',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{

        $password = $request->password;
        $hashedPassword = Hash::make($password);

        $user = User::where('email',$request->email)->first();
        if($user){
          if ($user && Hash::check($request->password, $user->password)) {
            if($user->status == 1 ){

              $user_creat_session = User::where('email', $request->email)->first();

              $user_login_time_set = User::where('email',$request->email)->update([
                'Login_time' => now(),
              ]);

                session(['phone_number' => $user_creat_session->phone_number]);
                session(['name' => $user_creat_session->name]);
                session(['user_id' => $user_creat_session->id]);
                session(['user_uuid' =>$user_creat_session->uuid]);
                session(['user_email' => $user_creat_session->email]);

              return response()->json([
                'status' => true,
                'number'=>'user login Successfull',
                'message' => $user_creat_session->name,
              ],200);
            }else{
              return response()->json([
                'status' => false,
                'errors'=>'Your account has been blocked.',
              ],401);
            }
          }else{
            return response()->json([
              'status' => false,
              'errors'=>'Incorrect email and password',
            ],401);
          }
        }else{
          return response()->json([
            'status' => false,
            'errors'=>'Incorrect email and password',
          ],401);
        }
      }
    }
    //Logoutuser
    public function Logout(){

      $user_login_time_set = user::where('email',session('email'))->update([
       'Logout_time' => now(),
      ]);
      session()->flush();
    }
}
