<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin\adminModels;


class AdminController extends Controller
{
  public function insert_admin(Request $request){
    $validateUser =Validator::make(
        $request->all(),
          [
            'name'  => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password'  =>'required|min:8',
            'profile'  =>'required|min:8',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'status' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
          // 'dd' => dd(request()->all());
        ],401);
      }else{
        
        $uuid = Str::uuid()->toString();

        $password = Hash::make($request->password);
        $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $path = $request->file('profile')->store('Admin_img', 'public');

         
        $user = adminModels::create([
          'uuid'         => $uuid,
          'name'         => $request->name,
          'email'        => $request->email,
          'phone'        => $request->phone,
          'password'     => $password,
          'Profile'      => $path,
          'otp'          => $otpCode,
        ]);
        
        
        return response()->json([
          'ststus' => true,
          'massege'=>'Admin insert Successfull',
           'user' =>$user,
        ],200);
      }
    }
    
    
    //end allll 
    
    
    
    public function showLoginForm()
    {
      return view('admin.Control_panel');
    }

    public function login(Request $request)
    {
        $admin = adminModels::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin_id' => $admin->id]);
            session(['admin_uuid' => $admin->uuid]);
            session(['admin_email' => $admin->email]);
            
            $setLoginTime = adminModels::where('id',$admin->id)->update([
              'last_login_at' => now(),
              'last_seen' => Now('Asia/Dhaka'),

            ]);
            
            
            
            
            return redirect()->route('admin.dashboord');
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function dashboard()
    {
        return view('admin.dashboord');
    }
    
    
    public function logout(Request $request)
      {
       // Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/Control-panel');
      }
    
    
}
