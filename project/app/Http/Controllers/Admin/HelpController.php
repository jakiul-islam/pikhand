<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\help;

class HelpController extends Controller
{
    public function store(request $request){
      $validateHelp =Validator::make(
        $request->all(),
          [
            'helpPage'  => 'required',
          ]
      );
      if($validateHelp->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateHelp->errors()->all(),
        ],401);
      }else{
        $helpCount = help::count();
        if($helpCount > 0){
          $help  = help::first();
          $user = $help->update([
            'page'=>$request->helpPage,
          ]);
        }else{
          $user = help::create([
            'page'=>$request->helpPage,
          ]);
        }
        return response()->json([
          'ststus' => true,
          'message'=>'Help page create Successfull',
        ],200);
      }
    }
    //fetch brands
    public function index(){
      $Help = help::first();
      return response()->json([
        'ststus' => true,
        'Help'=>$Help,
      ],200);
    }
    
    
    public function Help(){
      $Help = help::first();
      
      return view('Frontend.Help', [
        'Help' => $Help,
      ]);
    }
    
    
}
