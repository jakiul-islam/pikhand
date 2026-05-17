<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;





class SearchController extends Controller
{
    public function search_item(Request $request)
    {
      $validateUser =validator::make(
        $request->all(),
          [
            'search_input'  => 'string',
          ]
      );
      
      $search = $request->search_input;
      
      $products = DB::table('products')->where('name', 'like', "%{$search}%")->get();
      $product_count = $products->count();
      $weblogo = DB::table('web_logos')->first();
      
      $topKeywords = DB::table('search')
        ->where('keyword', 'like', "%{$search}%")
        ->select('keyword', DB::raw('COUNT(*) as total'))
        ->groupBy('keyword')
        ->orderByDesc('total')
        ->limit(5)
        ->get();
      
      $yoursearch = DB::table('search')->where('ip_address',$request->ip())->first();
  
      $topKeywords_count = $topKeywords->count();

     // $products = DB::table('products')->get();
      return response()->json([
        'ststus'            => true,
        'products'          => $products,
        'product_count'     => $product_count,
        'topKeywords'       => $topKeywords,
        'topKeywords_count' => $topKeywords_count,
        'weblogo'           => $weblogo,
      ],200);
    }
    
    
    
    public function send_search_input(Request $request)
    {

        $userid = session('user_id');
        $search = $request->search_input;
      
        DB::table('search')->insert([
          'user_id'    => $userid,
          'keyword'    => $search,
          //'filters'    => json_encode($request->except('search')),
          'ip_address' => $request->ip(),
          'user_agent' => $request->userAgent(),
          'created_at' => now(),
          'updated_at' => now(),
        ]);

        $posts = DB::table('products')->where('name', 'like', "%{$search}%")->where('status', '1')->paginate(20);
        $productcount = $posts->count();

        $Categoryall = DB::table('categories')->get();
        $subcategoryall = DB::table('product_subcategories')->get();
        $rating = DB::table('product_reviews')->get();
        $weblogo = DB::table('web_logos')->first();

        return view('Frontend.search', [
          'posts' => $posts,
          'productcount' => $productcount,
          'Categoryall' => $Categoryall,
          'subcategoryall' =>  $subcategoryall,
          'rating'         =>$rating,
          'search_input'   =>$search,
          'weblogo'        =>$weblogo,
        ]);
        //return back()->withErrors(['email' => 'Invalid credentials']);
    }

}
