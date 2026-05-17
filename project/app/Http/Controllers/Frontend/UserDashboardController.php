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

class UserDashboardController extends Controller
{
    public function UserSessionChack(){
      if(session()->has('user_id')){
        $userid = session('user_id');
        $user = User::with('user_profile')->where('id',$userid)->first();
        return response()->json([
          'status' => true,
          'name'   => session('name'),
          'user'   => $user,
        ],200);
      }else{
        return response()->json([
          'status' => true,
          'message'   => 'server error , try agian',
        ],400);
      }
    }
   
}
