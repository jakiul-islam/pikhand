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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendgmail;


use App\Models\User;
use App\Models\user_address;

class RagistationController extends Controller
{
    public function userSinup(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'email'  => 'required|email',
          ]
      );

//gmail app passwords
//yzlk rrts jgya qtep



      if($validateUser->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Please enter a valid email address',
          //'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $countProduct   = User::where('email',$request->email)->count();
        if($countProduct < 1){
          $otp = rand(100000,999999);
            $uuid = Str::uuid()->toString();
         // $status  = 0 ;

          $user = User::insert([
            'phone_number' => 'null',
            'email'=>$request->email,
            'google_id' => 'email login',
            'otp_code' =>$otp,
            'status' => 0 ,
            'uuid'   => $uuid,
            'Login_time' => now(),
            'Logout_time' => now(),
            'created_at'=> now(),
          ]);


           $emailsend = Mail::to($request->email)->send(new sendgmail($otp));

            if($emailsend){
                return response()->json([
                    'status' => true,
                    'message' => 'Registration successful. OTP sent to your number.',
                    'email' =>$request->email,
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'errors'=>'Email send faild try agine.',
                ],401);
            }
        }else{
          return response()->json([
            'status' => false,
            'errors'=>'This email already exists.',
            ],401);
        }
      }
    }
    //otp chack section
    public function otpchack(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'otp' => 'required|digits:6',
            'email' => 'required|email',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Internal error..',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
       // $countProduct   = DB::table('users')->where('otp',$request->otp)->count();
        $countProduct =User::where('email',$request->email)->where('otp_code', $request->otp)->count(); // Returns how many users match the number and otp
        if($countProduct > 0){

          $users = User::where('email', $request->email)->first();
          $userstatus =$users->status;

          if( $userstatus < 1 ){
            $user = User::where('email',$request->email)->update([
              'status' => 1 ,
            ]);
          }


          return response()->json([
            'number'=>$request->email,
          ]);

        }else{
          return response()->json([
            'status' => false,
               // 'message'=>$countProduct,
            'error'=>'otp does not metch',
          ],401);
        }
      }
    }
    //resend otp
    public function resendotp(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'email' => 'required|email',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Faild try agian',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
       // $countProduct   = DB::table('users')->where('otp',$request->otp)->count();
        $countProduct = user::where('email', $request->email)->count(); // Returns how many users match the number and otp

        $otp = rand(100000,999999);

        if($countProduct > 0){
          $user = user::where('email',$request->email)->update([
            'otp_code' => $otp ,
          ]);


           $emailsend = Mail::to($request->email)->send(new sendgmail($otp));


          if($user){
            return response()->json([
              'status' => true,
              'message'=>'Otp resend successfull',
              'number' => $request->phoneInput,
            ],200);
          }else{
            return response()->json([
              'status' => false,
              'errors'=>'OTP does not match',
            ],401);
          }
        }

      }
    }
    //send user info
    public function userinfosend(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'email'      => 'required|email',
            'name'       => 'required|string',
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

        $countuser = user::where('email',$request->email)->where('status', 1)->count();

        if($countuser > 0){
          $user = user::where('email',$request->email)->update([
            'password' =>$hashedPassword,
            'name' => $request->name,
            'updated_at'   => now(),
          ]);

          $user_creat_session =user::where('email',$request->email)->where('status',
          1)->first();

          $user_login_time_set = user::where('email',$request->email)->where('status',1)->update([
            'Login_time' => now(),
          ]);



          if(session()->has('user')){
            session()->flush();
          }else{
            session(['number' => $user_creat_session->email]);
            session(['name' => $user_creat_session->name]);
            session(['user_id' => $user_creat_session->id]);
            session(['phone_number' => $user_creat_session->phone_number]);
            session(['user_uuid' => $user_creat_session->uuid]);




            return response()->json([
                'status' => true,
                'message'=>'user sign in Successfull',
                'number' => 'user sign in Successfull',
            ],200);
            }
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
