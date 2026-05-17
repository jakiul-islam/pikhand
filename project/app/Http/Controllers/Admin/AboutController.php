<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\web_logo;
use App\Models\Admin\categories;
use App\Models\Admin\product_subcategories;
use App\Models\Admin\about;

class AboutController extends Controller
{
  public function about(){

    $Categoryall = categories::all();
    $weblogo = web_logo::first();
    $subcategoryall = product_subcategories::all();
    $about = about::first();
    
    
    return view('Frontend.about', [
      'Categoryall'   => $Categoryall,
      'weblogo'         =>$weblogo,
      'subcategoryall' =>  $subcategoryall,
      'about' =>  $about,
    ]);
  }
  
    public function store(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'Aboutdescription'  => 'required',
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
        $helpCount = about::count();
        if($helpCount > 0){
          $about = about::first();
          $about->update([
            'page'=>$request->Aboutdescription,
          ]);
        }else{
          $about = about::create([
            'page'=>$request->Aboutdescription,
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
      $about = about::first();
      return response()->json([
        'ststus' => true,
        'about'  =>$about,
      ],200);
    }
    

}
