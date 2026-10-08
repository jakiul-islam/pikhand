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
    public function create(request $request){
      $validate_message =Validator::make(
        $request->all(),
          [
            'messageInput'          => 'required|string',
            'sender'          => 'required|string',
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
             session(['gust_uuid' => $gust_uuid_for_DB->name]);
           }
         }

    
        
        $uuid = Str::uuid()->toString();
        
        $User_message = message::create([
          'uuid'         =>$uuid,
          'gust_uuid'    =>            
          'Message'      =>$request->messageInput,       
          ...(session()->has('user_id') ? ['user_id' => session('user_id')] : []),
        ]);
        return response()->json([
          'status' => true,
          'message'=>'insert img Successfull',
           'brand' =>$User_message,
        ],200);
      }
    }
    //fetch brands
    public function index(){
      
      $Message = message::get();
      return response()->json([
        'message' => $Message,
      ]);
      
    }
    //eidte brands 
    public function update(request $request ,ImageService $imageService){
      $validateUser =Validator::make(
        $request->all(),
          [
            'id'              => 'required|string',
            'name'            => 'required|string',
            'slug'            => 'required|string',
            'meta_title'      => 'required|string',
            'meta_keyword'    => 'required|string',
            'meta_description'=> 'required|string',
            'description'     => 'required|string',
          ]
        );
      $brand = brand::where('id',$request->id)->first();
      if(!empty($request->img)){
        $validateUser =Validator::make(
          $request->all(),
            [
              'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            ]
        );
        if($validateUser->fails()){
          return response()->json([
            'ststus' => false,
            'message'=> "Validation errors is",
            'errors' =>$validateUser->errors()->all(),
          ],401);
        }else{

          $Edit_img_file = $request->file('img');

          $Edit_img_path = $imageService->upload(
            $Edit_img_file,
            'brand',
            1200,
            80
          );

          
        
          Storage::disk('public')->delete( $brand->logo); 

          $brand_update = $brand->update([
            'logo' => $Edit_img_path,
          ]);
        }
      }
        if($validateUser->fails()){
          return response()->json([
            'ststus' => false,
            'message'=> "Validation errors is",
            'errors' =>$validateUser->errors()->all(),
          ],401);
        }else{
          $brand_update = $brand->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'logo' =>$Edit_img_path,
          ]);
          return response()->json([
            'ststus' => true,
            'message'=>'Brand update Successfull',
            'brand_update' =>$brand_update,
          ],200);
        }
    }
    
    //end edite brand 
    //delete brand
    public function delete(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'id'  => 'required|integer|exists:brands,id',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
      //delete
        $chackProduct = product::where('brand_id', $request->id)->count();
        if($chackProduct){
          return response()->json([
            'status' => false,
            'message'=>'This brand use by'.$chackProduct.'product',
          ],200);
        }else{
          $brand_delete = brand::where('id', $request->id)->first();
          if ($brand_delete) {
           
             Storage::disk('public')->delete( $brand_delete->logo); 
            
              $deteletdata = brand::where('id', $request->id)->delete();
              return response()->json([
                'status' => true,
                'message'=>'Brand deleted successfull',
                'user' =>$deteletdata,
              ],200);
          } else {
            return response()->json([
              'status' => false,
              'message'=>'Category not found',
            ],404);
          }
        }
      }
    }
    //brand status update 
    public function statusUpdate(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'id'            => 'required|integer|exists:brands,id',
            'statusSwitch'  => 'required|integer',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
      //delete
        $brand = brand::where('id', $request->id)->first();
        
        $chackProduct = product::where('brand_id', $request->id)->count();
        if($chackProduct > 0){
          if($request->statusSwitch == 1){
            $brand->update([
              'status' => $request->statusSwitch,
            ]);
            return response()->json([
              'status' => true,
              'message'=>'Brand active successfull',
            ],200);
          }else{
            return response()->json([
              'status' => false,
              'message'=>'This brand use by'.$chackProduct.'product',
            ],200);
          }
        }else{
          $brand->update([
            'status' => $request->statusSwitch,
          ]);
          if($request->statusSwitch == 1){
            $message = 'Brand active successfull';
          }else{
            $message = 'Brand unactive successfull';
          }
          return response()->json([
            'status' => true,
            'message'=>$message,
          ],200);
        }
      }
    }

    
}