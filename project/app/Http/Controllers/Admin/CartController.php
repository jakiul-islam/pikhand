<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

use App\Models\crats;



class CartController extends Controller
{
    
    public function index(request $request){
      
      $query = crats::with(['user','product'])->orderBy('id', 'desc' );
    
      if($request->time){
        $time = Carbon::parse($request->time)->format('Y-m-d H:i:s');
        $query->where('created_at', '>', $time);
      }
    
      if($request->search_input){
        $query->where('quantity', 'like', '%'.$request->search_input.'%')
          ->orWhereHas('user', function($q) use ($request) {
              $q->where('name', 'like', '%'.$request->search_input.'%')
                ->orWhere('phone_number', 'like', '%'.$request->search_input.'%');
          })
          ->orWhereHas('product', function($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->search_input.'%');
                });
      }

      
      $carts = $query->paginate(10);
      
        return response()->json([
          'ststus' => true,
          'carts'  => $carts,
        ],200);
      
    }
    
  //order deteils

  public function details(request $request){
    $cartid = $request->cartid;
    $carts = crats::with('user', 'product')->where('id' , $cartid )->first();
    
    return response()->json([
      'ststus'     => true,
      'carts'      =>$carts,
    ],200);
      
  }
    
    
    
}
