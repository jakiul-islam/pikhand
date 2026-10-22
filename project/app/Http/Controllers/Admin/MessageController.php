<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;



use App\Services\ImageService;

use App\Models\admin\adminModels;
use App\Models\Admin\message;
use App\Models\admin\product;
use App\Models\User;
use App\Models\order;


class MessageController  extends Controller
{
    //admin section 
    public function alluserIndex(){
      
     $messagesAll = message::with('user')
    ->where(function ($query) {
        $query->whereIn('id', function ($subQuery) {
            $subQuery->selectRaw('MAX(id)')
                ->from('message')
                ->whereNotNull('user_id')
                ->groupBy('user_id');
        })
        ->orWhereIn('id', function ($subQuery) {
            $subQuery->selectRaw('MAX(id)')
                ->from('message')
                ->whereNull('user_id')
                ->whereNotNull('guest_uuid')
                ->groupBy('guest_uuid');
        });
    })
    ->latest('created_at')
    ->get();



      
      return response()->json([
        'messageAllUser' => $messagesAll,
      ]);
      
    }
   
  
    public function openChat( request $request){

      $validate_message =Validator::make(
        $request->all(),
          [
            'userId'          => 'required|string',
          ]
      );
      if($validate_message->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validate_message->errors()->all(),
        ],401);
      }else{
      
           $messagesAll = message::where('user_id', $request->userId)
          ->orWhere('guest_uuid', $request->userId)
          ->oldest('created_at')
          ->get();

      
        return response()->json([
          'userMessageIndex' => $messagesAll,
        ]);

        
      }
    }


   public function create(request $request){
      $validate_message =Validator::make(
        $request->all(),
          [
            'message'          => 'required|string',
          ]
      );
      if($validate_message->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validate_message->errors()->all(),
        ],401);
      }else{
         if(session()->has('admin_uuid') ){
           if(session()->has('guest_uuid')){
             $gust_uuid_for_DB =  session('guest_uuid');
             $guestId = session('guest_id');
           }

      }
        
        $uuid = Str::uuid()->toString();
        
      //  $User_message = message::create([
     //     'uuid'         =>$uuid,
     //     'Message'      =>$request->messageInput,  
       //   ...(session()->has('user_id') ? ""  
    //        : [ ...(session()->has('guest_id')   ? [ 'guest_id' => $guestId, ] : []) ]
     //     ),

    //      ...(session()->has('user_id') ? ['user_id' => session('user_id')] : [ 'guest_uuid'    => $gust_uuid_for_DB ]),
    //    ]);


        $User_message = message::create([
            'uuid'    => $uuid,
            'Message' => $request->messageInput,
        
            ...(session()->has('user_id')
                ? ['user_id' => session('user_id')]
                : [
                    'guest_uuid' => $gust_uuid_for_DB,
                    'guest_id'   => $guestId,
                ]
            ),
        ]);


        

        
        return response()->json([
          'status' => true,
          'message'=>'Message insert Successfull',
          'user_message' =>$User_message,
        ],200);
      }
    }
    //fetch message user section

}