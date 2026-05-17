<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Admin\adminPage;
use App\Models\Admin\access;
use App\Models\Admin\adminModels;

class AdminListController extends Controller
{
  // chacked login admin super admin or not
  public function chackSoparAdmin(){
    $admin = session('admin_uuid');
    $user      = adminModels::where('status','1')->where('uuid',$admin)->where('role','super_admin')->first();
    $usercount = adminModels::where('status','1')->where('uuid',$admin)->where('role','super_admin')->count();

    return view('Admin.admin.admin_list', [
      'user'      => $user,
      'usercount' => $usercount,
    ]);
  }
  // Fetch all admin 
  public function FetchAdminList(){
    $admin = session('admin_uuid');
        
    $usercount = adminModels::where('status','1')->where('uuid',$admin)->where('role','super_admin')->count();
    $FetchAdmin = adminModels::orderBy('last_login_at','desc')->get();
    
    return response()-> json([
      'status'     => true,
      'usercount'  => $usercount,
      'FetchAdmin' => $FetchAdmin,
    ]);
    
  }
  //delete admin 
  public function AdminDelete(Request $request){
    $validateUser =Validator::make(
      $request->all(),
      [
        'uuid'       => 'required|string|max:255',
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
        $FetchAdmin = adminModels::where('uuid',$request->uuid)->where('role','super_admin')->count();
        if($FetchAdmin < 1){
          $admindeleted = adminModels::where('uuid',$request->uuid)->delete();
          return response()-> json([
            'status'   => true,
            'message'  => 'deleted successfull !',
          ]);
        }else{
          return response()-> json([
            'status'     => true,
            'message'  => 'soper admin is not deleted',
          ]);
        }
      }else{
        return response()-> json([
          'status'     => true,
          'message'  => 'Your are not edit this page',
        ]);
      }
    }
  }
  // admin deteils and access controll 
  public function AdminDatilsAndAccess(Request $request){
    $validateUser =Validator::make(
      $request->all(),
      [
        'uuid'       => 'required|string|max:255',
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
        
        $admin = adminModels::where('status','1')->where('uuid',$request->uuid)->first();
        $page = adminPage::where('status','1')->get();
        $access = access::where('admin_uuid',$request->uuid)->get();

       
        return response()-> json([
          'status'   => true,
          'message'  => 'successfull',
          'admin'    => $admin,
          'page'     => $page,
          'access'   => $access,
        ]);
      }else{
        return response()-> json([
          'status'     => false,
          'message'  => 'You cannot access this page',
        ]);
      }
    }
  }
  
  public function actionButton(Request $request){
    $validateUser =Validator::make(
      $request->all(),
      [
        'uuid'       => 'required|string|max:255',
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
        $FetchAdmin = adminModels::where('uuid',$request->uuid)->where('role','super_admin')->count();
        if($FetchAdmin < 1){
          $admindeleted = adminModels::where('uuid',$request->uuid)->update([
            'status' => $request->statusValue,
          ]);
          
          
          if($request->statusValue == 0){
            return response()-> json([
              'status'   => true,
              'message'  => 'Admin unactive successful' ,
            ]);
          }else{
            return response()-> json([
              'status'   => true,
              'message'  => 'Admin active successful' ,
            ]);
          }
          
        }else{
          return response()-> json([
            'status'     => false,
            'message'  => 'You cannot unactive super admin',
          ]);
        }
      }else{
        return response()-> json([
          'status'     => false,
          'message'  => 'You cannot unactive admin',
        ]);
      }
    }
  }
  //AccessInAble
  public function AccessInAble(Request $request){
    $validateUser =Validator::make(
      $request->all(),
      [
        'pagenName'       => 'required|string|max:255',
        'adminuuid'       => 'required|string|max:255',
        'status'          => 'required|string|max:255',
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
        
        $FetchAdmin = adminModels::where('uuid',$request->uuid)->where('role','super_admin')->count();
        
        if($FetchAdmin < 1){
          
          if( $request->status == 1 ){
            $admindeleted = access::create([
              'pagename'   => $request->pagenName,
              'admin_uuid' => $request->adminuuid,
            ]);
            return response()-> json([
              'status'   => true,
              'message'  => 'Admin has been successfully granted access to ' . $request->pagenName . ' page',
            ]);
          }else{
            $admindeleted = access::where('pagename', $request->pagenName)->where('admin_uuid', $request->adminuuid )->delete();
            return response()-> json([
              'status'   => true,
              'message'  => 'Admin has been denied access to ' . $request->pagenName . ' page',
            ]);
          }
        }else{
          return response()-> json([
            'status'     => false,
            'message'  => 'You cannot unactive super admin',
          ]);
        }
      }else{
        return response()-> json([
          'status'     => false,
          'message'  => 'You cannot unactive admin',
        ]);
      }
    }
  }
  
  public function updatelastseenlogout(Request $request){
    $admin = session('admin_uuid');
      $admindeleted = adminModels::where('uuid',$admin)->update([
        'last_seen' => Now('Asia/Dhaka'),
      ]);
  }
  
}
