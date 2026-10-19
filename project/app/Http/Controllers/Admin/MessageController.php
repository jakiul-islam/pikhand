<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;



use App\Services\ImageService;

use App\Models\admin\adminModels;
use App\Models\Admin\message;
use App\Models\admin\product;
use App\Models\User;
use App\Models\order;


class MessageController  extends Controller
{
    //admin section 
    public function alluserIndex(){
      
     $messagesAll = message::whereIn('id', function ($query) {
        $query->selectRaw('MAX(id)')
          ->from('message')
          ->whereNotNull('user_id')
          ->groupBy('user_id');
        })
    ->orWhereIn('id', function ($query) {
      $query->selectRaw('MAX(id)')
        ->from('message')
        ->whereNotNull('gust_uuid')
        ->groupBy('gust_uuid');
    })
    ->latest('created_at')
    ->get();



      
      return response()->json([
        'messageAllUser' => $messagesAll,
      ]);
      
    }


  
}