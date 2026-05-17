<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\feedback;
use App\Models\User;
use App\Models\user_profile;


class FeedbackController extends Controller
{
    public function create(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'name'       => 'required|string',
            'email'      => 'required|email',
            'star'       => 'required|string',
            'message'    => 'string',
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
        $user_id = session('user');

        $chack = feedback::where('user_id',$user_id)
          ->count();

        if($chack < 1){
          $user = feedback::create([
            'name'           =>$request->name,
            'user_id'        =>$user_id,
            'email'          =>$request->email,
            'ratingNumber'   =>$request->star,
            'massage'        =>$request->message,

          ]);
        }else{

          $feedback = feedback::where('user_id',$user_id)->first();
          $feedback->update([
            'name'           =>$request->name,
            'email'          =>$request->email,
            'ratingNumber'   =>$request->star,
            'massage'        =>$request->message,
          ]);

         /* return response()->json([
            'status' => true,
            'result' => '⚠️ You have already subscribed.',
          ], 200); */
        }

        return response()->json([
          'status' => true,
          'result' => 'subscribed successfull'
        ], 200);

      }
    }
    //fetch feedback
    public function index(request $request){
      //delete
      $user_id = session('user');

      $ThisUserFeedback = feedback::where('user_id',$user_id)->all();

      $ThisUserFeedbackFetch = feedback::where('user_id',$user_id)->first();



      $AllFeedback = feedback::all();

      $Allusers = User::all();

      $Allusersprofile = user_profile::get();

      $thisusersprofile = user_profile::where('user_id',$user_id)->first();

      $ThisUserFeedbackCount = $ThisUserFeedback->count();
        return response()->json([
          'status'                => true,
          'AllFeedback'           => $AllFeedback,
          'ThisUserFeedbackCount' => $ThisUserFeedbackCount,
          'ThisUserFeedbackFetch' => $ThisUserFeedbackFetch,
          'Allusers'              => $Allusers,
          'Allusersprofile'       => $Allusersprofile,
          'thisusersprofile'      => $thisusersprofile,
        ], 200);
    }
}
