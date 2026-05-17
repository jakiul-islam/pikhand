<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\policie;

class PoliciesController extends Controller
{
    public function store(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'Policiesdescription'  => 'required',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
          // 'dd' => dd(request()->all());
        ],401);
      }else{
        $helpCount = policie::count();
        if($helpCount > 0){
          $policie = policie::first();
          $policie->update([
            'page'=>$request->Policiesdescription,
          ]);
        }else{
          $policie = policie::create([
            'page'=>$request->Policiesdescription,
          ]);
        }
        return response()->json([
          'ststus' => true,
          'message'=>'insert img Successfull',
           'user' =>'',
        ],200);
      }
    }
    //fetch brands
    public function index(){
      $policies = policie::first();
      return response()->json([
        'ststus' => true,
        'policies'=>$policies,
      ],200);
    }
    
    
    public function Policies(){
      $Policies = policie::first();
      return view('Frontend.policies', [
        'Policies' => $Policies,
      ]);
    }
    
    
}
