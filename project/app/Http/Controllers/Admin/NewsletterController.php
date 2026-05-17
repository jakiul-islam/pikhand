<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\newsletter_containt;



class NewsletterController extends Controller
{
    public function update(request $request){
      $validateUser =Validator::make(
        $request->all(),
          [
            'News_title'     => 'required|string',
            'newssubtitle'   => 'required|string',
            'newssubtitle_2' => 'required|string',
          ]
      );
      if($validateUser->fails()){
        return response()->json([
          'ststus' => false,
          'message'=>'Validation Error Is',
          'errors' =>$validateUser->errors()->all(),
        ],401);
      }else{
        $chack = newsletter_containt::count();
        if($chack > 0){
          $newsletter_containt = newsletter_containt::first();
          $newsletter = $newsletter_containt->update([
            'title'        =>$request->News_title,
            'subtitle'     =>$request->newssubtitle,
            'subtitle_2'   =>$request->newssubtitle_2,
          ]);
          $message = 'News letter update successfull';
        }else{
          $newsletter = newsletter_containt::create([
            'title'        =>$request->News_title,
            'subtitle'     =>$request->newssubtitle,
            'subtitle_2'   =>$request->newssubtitle_2,
          ]);
          $message = 'News letter create successfull';
        }
          return response()->json([
            'ststus'     => true,
            'message'    =>$message,
            'newsletter' =>$newsletter,
          ],200);
      }
    }
    //fetch brands
    public function index(){
        $newsletter = newsletter_containt::first();
        return response()->json($newsletter);
    }
}
