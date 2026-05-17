<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\password_policie;

class SecurityController extends Controller
{
    public function password_policies_fetch(){
      $password_policies = password_policie::first();
      return response()->json([
        'ststus' => true,
        'password_policies'=>$password_policies,
      ],200);
    }
    //update password policies
    public function updatePasswordPolicies(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'inputValue'  => 'required',
            'idName'  => 'required',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $password_policies = password_policie::count();
        if($password_policies > 0){
          $password_policiesUpdate = password_policie::first();
          $password_policiesUpdate->update([
            $request->idName => $request->inputValue,
          ]);
        }else{
          $password_policiesUpdate = password_policie::create([
            'policy_name'=>'defolt',
            'min_length'=>'8',
            'max_length'=>'20',
            'require_uppercase'=>'1',
            'require_numbers'=>'1',
            'require_special_chars'=>'1',
            'password_expiration_days'=>'365',
            'require_special_chars'=>'1',
          ]);
        }
        return response()->json([
          'ststus' => true,
          'message'=>'insert img Successfull',
          'password_policiesUpdate' =>$password_policiesUpdate,
        ],200);
      }
    }
    
}
