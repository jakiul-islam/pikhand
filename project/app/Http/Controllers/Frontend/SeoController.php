<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use App\Models\Admin\seo_settings;
use App\Models\Admin\page_seo;
class SeoController extends Controller
{
    public function update_seo(request $request){
      $validateUser =validator::make(
        $request->all(),
          [
            'site_name'  => 'required|string',
            'site_tagline' => 'required|string',
            'default_meta_title' => 'required|string',
            'default_meta_description' => 'required|string',
            //'default_og_image' => 'required|string',
            'favicon' => 'required|string',
            'google_analytics_id'  =>'required|string',
            'google_search_console'  =>'required|string',
            'bing_webmaster'  =>'required|string',
            'schema_organization'  =>'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        if(!empty($request->default_og_image)){
          $validateUser =Validator::make(
            $request->all(),
            [
              'default_og_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            ]
          );
          if($validateUser->fails()){
            return response()->json([
              'ststus' => false,
              'message'=> "Validation errors is",
              'errors' =>$validateUser->errors()->all(),
            ],401);
          }else{
            $path = $request->file('default_og_image')->store('seo_settings', 'public');
            $editeseo_settings = seo_settings::first();
            $editeimagePath = storage_path('app/seo_settings/' . $editeseo_settings->default_og_image);
            $editeimagePathpub = public_path('seo_settings/' . $editeseo_settings->default_og_image);
            File::delete($editeimagePath);
            File::delete($editeimagePathpub);
            
            $seo_update_img = seo_settings::update([
              'default_og_image'=>$path,
            ]);
            
          }
        }
          
            $seo_update = seo_settings::first();
              $seo_update->update([
              'site_name'=>$request->site_name,
              'site_tagline'=>$request->site_tagline,
              'default_meta_title'=>$request->default_meta_title,
              'default_meta_description'=>$request->default_meta_description,
              'favicon' => $request->favicon,
              'google_analytics_id' => $request->google_analytics_id,
              'google_search_console' => $request->google_search_console,
              'bing_webmaster' => $request->bing_webmaster,
              'schema_organization' => $request->schema_organization,
              'updated_at'   => now(),
            ]);
            
            
            return response()->json([
              'ststus' => true,
              'message'=>'Seo Update Successfull',
              'seo_update' =>$seo_update,
            ],200);
      }
    }
    //fetch category
    public function fetch_seo(){
      $seo_settings = seo_settings::first();
      return response()->json([
            'ststus' => false,
            'seo_settings' => $seo_settings,
          ]);
    }
    
    //page seo setting
    
    public function pageSEOinsert(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'page_url'  => 'required|string|unique:page_seo,page_url',
            'page_meta_title' => 'required|string|max:255',
            'page_meta_description' => 'required|string|max:500',
            'page_meta_keywords' => 'nullable|string',
            'page_og_image' => 'nullable', // অথবা image যদি আপলোড হয়
            'page_canonical_url' => 'nullable|url',
            'page_robots_meta'  => 'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        
        $pagepath = $request->file('page_og_image')->store('seo_settings', 'public');
        
        $page_seo_create = page_seo::create([
          'page_url'=>$request->page_url,
          'meta_title'=>$request->page_meta_title,
          'meta_description'=>$request->page_meta_description,
          'meta_keywords'=>$request->page_meta_keywords,
          'og_image'=>$pagepath,
          'canonical_url' => $request->page_canonical_url,
          'robots_meta' => $request->page_robots_meta,
        ]);
        return response()->json([
          'ststus' => true,
          'message'=>'Page seo create Successfull',
          'page_seo_create' =>$page_seo_create,
        ],200);
      }
    }
    
     //page fetch category
    public function page_fetch_seo(){
      $page_seo_settings = page_seo::get();
      return response()->json([
            'ststus' => false,
            'page_seo_settings' => $page_seo_settings,
          ]);
    }
    
    //page seo setting 
    
    public function editpageSEOinsert(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'id'                    => 'required',
            'page_url'              => 'required|string',
            'page_meta_title'       => 'required|string|max:255',
            'page_meta_description' => 'required|string|max:500',
            'page_meta_keywords'    => 'nullable|string',
            'page_canonical_url'    => 'nullable|url',
            'page_robots_meta'      => 'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        if(!empty($request->edit_page_og_image)){
          $validateUser =Validator::make(
            $request->all(),
            [
              'edit_page_og_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10250',
            ]
          );
          if($validateUser->fails()){
            return response()->json([
              'ststus' => false,
              'message'=> "Validation errors is",
              'errors' =>$validateUser->errors()->all(),
            ],401);
          }else{
            $page_seo_path = $request->file('edit_page_og_image')->store('seo_settings', 'public');
            $editeseo_settings = DB::table('page_seo')->where('id',$request->id)->first();
            $editeimagePath = storage_path('app/seo_settings/' . $editeseo_settings->og_image);
            $editeimagePathpub = public_path('seo_settings/' . $editeseo_settings->og_image);
            File::delete($editeimagePath);
            File::delete($editeimagePathpub);
          }
        }else {
          $validateUser =Validator::make(
            $request->all(),
            [
              'old_page_og_image' => 'required',
            ]
          );
          if($validateUser->fails()){
            return response()->json([
              'ststus' => false,
              'message'=> "Validation errors is",
              'errors' =>$validateUser->errors()->all(),
            ],401);
          }else{
            $page_seo_path = $request->input('old_page_og_image');
          }
        }
        if(empty($page_seo_path)){
          return response()->json([
            'ststus' => false,
            'message'=> "pless give me veleate img",
          ],401);
        }else{
          if($validateUser->fails()){
            return response()->json([
              'ststus' => false,
              'message'=> "Validation errors is",
              'errors' =>$validateUser->errors()->all(),
            ],401);
          }else{
          
            $user = page_seo::where('id',$request->id)->update([
              'page_url'=>$request->page_url,
              'meta_title'=>$request->page_meta_title,
              'meta_description'=>$request->page_meta_description,
              'meta_keywords'=>$request->page_meta_keywords,
              'og_image'=>$page_seo_path,
              'canonical_url' => $request->page_canonical_url,
              'robots_meta' => $request->page_robots_meta,
              'created_at'   => now(),
            ]);
            
            return response()->json([
              'ststus' => true,
              'message'=>'insert img Successfull',
              'user' =>$user,
            ],200);
          }
        }
      }
    }
   
   //delete page seo 
   
    public function deletepageSEO(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'deleteid'  => 'required',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=> "Validation errors is",
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        
        
          $editeseo_settings = DB::table('page_seo')->where('id',$request->deleteid)->first();
          $editeimagePath = storage_path('app/seo_settings/' . $editeseo_settings->og_image);
          $editeimagePathpub = public_path('seo_settings/' . $editeseo_settings->og_image);
          File::delete($editeimagePath);
          File::delete($editeimagePathpub);
        
        
        
        $user =  page_seo::where('id',$request->deleteid)->delete();
        
          return response()->json([
            'ststus' => true,
            'message'=>'insert img Successfull',
            'user' =>$user,
          ],200);
          
        return response()->json([
          'ststus' => false,
          'message'=>'category edite is not Successfull',
          'errors' =>$validateUser->errors()->all(),
        ],401);
        
      }
    }
   
   
   
}
