<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\adminPage;
use App\Models\Admin\adminModels;


class AccessController extends Controller
{
  
  // insert admin page name
  public function adminInsertPage(Request $request){
    $validateUser =Validator::make(
      $request->all(),
      [
        'pageName'       => 'required|string|max:255',
      ]
    );
    if($validateUser->fails()){
      return response()->json([
        'status' => false,
        'message'=>'Validation Error Is',
        'errors' =>$validateUser->errors()->all(),
      ],422);
    }else{
      $admin = session('admin_uuid');
      $usercount = adminModels::where('status','1')->where('uuid',$admin)->where('role','super_admin')->count();
      if($usercount > 0 ){
        $page = adminPage::create([
          'pageName' => $request->pageName,
          'admin_uuid'     => $admin,
        ]);
        return response()-> json([
          'status'     => false,
          'message'  => 'page insert successfull',
        ]);
      }else{
        return response()-> json([
          'status'     => false,
          'message'  => 'You cannot insert admin page',
        ]);
      }
    }
    
    return response()->json([
      'status' => false,
      'message'=>'Validation Error Is',
    ],401);
    
  }
  
  //fetch admin page 
  public function FetchAdminPage(Request $request){
    
    $admin = session('admin_uuid');
    $usercount = adminModels::where('status','1')->where('uuid',$admin)->where('role','super_admin')->count();
    if($usercount > 0 ){
      $page = adminPage::all();
      return response()-> json([
        'status'  => true,
        'page'    => $page,
      ],200);
    }else{
      return response()-> json([
        'status'     => false,
        'message'  => 'admin page does not fetch',
      ],200);
    }
    
    return response()-> json([
      'status'     => false,
      'message'  => 'admin page does not fetch',
    ],401);
  }
  //status Upadate
  public function statusUpadate(Request $request){
    $validateUser =Validator::make(
      $request->all(),
      [
        'id'       => 'required|string|max:255',
        'statusValue'       => 'required|string|max:255',
      ]
    );
    if($validateUser->fails()){
      return response()->json([
        'status' => false,
        'message'=>'Validation Error Is',
        'errors' =>$validateUser->errors()->all(),
      ],422);
    }else{
      $admin = session('admin_uuid');
      $usercount = adminModels::where('status','1')->where('uuid',$admin)->where('role','super_admin')->count();
      if($usercount > 0 ){
        $page = adminPage::find($request->id);
        $page->update([
          'status' => $request->statusValue,
        ]);
        if( $request->statusValue > 0 ){
          return response()-> json([
            'status'     => true,
            'message'  => 'page active successfull',
          ]);
        }else{
          return response()-> json([
            'status'     => true,
            'message'  => 'page unactive successfull',
          ]);
        }
      }else{
        return response()-> json([
          'status'     => false,
          'message'  => 'You cannot unactive admin page',
        ]);
      }
    }
    
    return response()->json([
      'status' => false,
      'message'=>'try agin',
    ],401);
    
  }
  // delete admin page
  public function deleteAdminPage(Request $request){
    $validateUser =Validator::make(
      $request->all(),
      [
        'id'       => 'required|string|max:255',
      ]
    );
    if($validateUser->fails()){
      return response()->json([
        'status' => false,
        'message'=>'Validation Error Is',
        'errors' =>$validateUser->errors()->all(),
      ],422);
    }else{
      $admin = session('admin_uuid');
      $usercount = adminModels::where('status','1')->where('uuid',$admin)->where('role','super_admin')->count();
      if($usercount > 0 ){
        
        $page = adminPage::find($request->id);
        $page->delete();

        return response()-> json([
          'status'     => true,
          'message'  => 'Admin page deleted successfull',
        ]);
          
      }else{
        return response()-> json([
          'status'     => false,
          'message'  => 'You cannot Admin admin page',
        ]);
      }
    }
    
    return response()->json([
      'status' => false,
      'message'=>'try agin',
    ],401);
    
  }


}
