<?php

namespace App\Http\Controllers\Frontend;

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


class messageController  extends Controller
{
    public function create(request $request){
      $validate_message =Validator::make(
        $request->all(),
          [
            'messageInput'          => 'required|string',
            'sender'                => 'required|string',
          ]
      );
      if($validate_message->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validate_message->errors()->all(),
        ],401);
      }else{
         if(! session()->has('user_id') ){
           if(session()->has('gust_uuid')){
             $gust_uuid_for_DB =  session('gust_uuid');
           }else{
             $gust_uuid_for_DB = Str::uuid()->toString();
             session(['gust_uuid' => $gust_uuid_for_DB]);
              
              
              $lastNumber = message::whereNotNull('guest_id')
                  ->selectRaw(
                      "MAX(CAST(SUBSTRING_INDEX(guest_id, '#', -1) AS UNSIGNED)) as number"
                  )
                  ->value('number');
          
              $guestNumber = max(1000, (int) $lastNumber) + 1;
              
              session(['guest_id' => 'Guest #' . $guestNumber]);
    
              $guestName = session('guest_name');




             
           }
         }

    
        
        $uuid = Str::uuid()->toString();
        
        $User_message = message::create([
          'uuid'         =>$uuid,
          'Message'      =>$request->messageInput,       
          ...(session()->has('user_id') ? ['user_id' => session('user_id')] : [ 'gust_uuid'    => $gust_uuid_for_DB ]),
        ]);
        return response()->json([
          'status' => true,
          'message'=>'insert img Successfull',
           'brand' =>$User_message,
        ],200);
      }
    }
    //fetch message user section
    public function index(){

       if(session()->has('user_id') ){
          $user_id =  session('user_id');
          $Message = message::where('user_id', $user_id)->get();
        }else{
          if(session()->has('gust_uuid')){
             $gust_uuid_for_DB =  session('gust_uuid');

      
             $Message = message::where('gust_uuid', $gust_uuid_for_DB)->get();
            
          }
        }




      return response()->json([
        'message' => $Message,
      ]);
      
    }
  
  
}