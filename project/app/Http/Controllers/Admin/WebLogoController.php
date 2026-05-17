<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\web_logo;


class WebLogoController extends Controller
{
  public function insertWebLogo(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'webName'     => 'required',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $chack = web_logo::count();
        $logo = web_logo::first();
        
        if($chack > 0){
          if( isset($request->Web_Iogo)){
            
            $Newpath = $request->file('Web_Iogo')->store('logo', 'public');
            $editeimagePath = storage_path('app/public/' . $logo->logo);
            File::delete($editeimagePath);
            
            $logo->update([
              'name'      =>$request->webName,
              'logo'      =>$Newpath,
            ]);
            
            return response()->json([
              'ststus' => true,
              'massege'=>'Web info update Successfull',
            ],200);
            
          }else{
            $logo->update([
              'name'      =>$request->webName,
            ]);
            
            return response()->json([
              'ststus' => true,
              'massege'=>'name update Successfull',
            ],200);
          }
        }else{
          $path = $request->file('Web_Iogo')->store('logo', 'public');
    
          $user = web_logo::create([
            'name'        =>$request->webName,
            'logo'         =>$path,
          ]);
          
          return response()->json([
            'ststus' => true,
            'massege'=>'insert img Successfull',
          ],200);
          
        }
      }
    }
    //fetch brands
    public function fetchweblogo(){
        $webLogo = web_logo::first();
        return response()->json($webLogo);
    }

}
