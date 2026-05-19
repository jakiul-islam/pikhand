<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\crats;
use App\Models\Admin\product;
use App\Models\product_reviews;

class CartController extends Controller
{
  public function create(request $request){
    $validateUser =validator::make(
      $request->all(),
        [
          'productId'      => 'required|numeric',
          'cartPrice'      => 'required|numeric',
        ]
    );

    if($validateUser->fails()){
      return response()->json([
        'ststus' => false,
        'message'=>'Validation Error Is',
        'errors' =>$validateUser->errors()->all(),
      ],401);
    }else{
      $ipAddress = request()->ip();
      if(session()->has('user_id')){
        $userid = session('user_id');
        $countProduct = crats::where('user_id', $userid)->where('product_id', $request->productId)->whereIn('status', ['Active', 'Ordered'])->count();
        if($countProduct < 1 ){
          $user = crats::create([
            'user_id'        =>$userid,
            'ipAddress'     =>$ipAddress,
            'product_id'    =>$request->productId,
            'product_price' =>$request->cartPrice,
          ]);
          return response()->json([
            'status' => true,
            'message'=>'Products add to cart',
            'errors' =>$validateUser->errors()->all(),
          ],200);
        }else{
          return response()->json([
            'status' => true,
            'message'=>'this products is allready add in cart',
            'errors' =>$validateUser->errors()->all(),
          ],200);
        }
      }else{
        return response()->json([
          'status' => false,
          'user'=>'guest',
        ],200);
      }
    }
  }

    //products carts section
    public function index(){
      
      
        $userid = session('user_id');
        $ipAddress = request()->ip();
        $carts          = crats::where('user_id',$userid)->whereIn('status', ['Active', 'Ordered'])->orderBy('id','desc')->get();
        $countProduct   = crats::where('user_id',$userid)->whereIn('status', ['Active', 'Ordered'])->count();
        $sessioncarts   = array_values(session()->get('cart', []));
        //$sessioncarts   = session()->get('cart', []);
        $sessioncountProduct = count($sessioncarts);
        $voucher = DB::table('vouches')->get();

        return response()->json([
          'all_carts'     => $carts,
          'countProduct'  =>$countProduct,
          'sessioncarts'  =>$sessioncarts,
          'sessioncountProduct' =>$sessioncountProduct,
          'voucher'            =>$voucher,
        ]);
    }

    public function cartsProductIndex(request $request){
      if(session()->has('user_id')){
        $userid = session('user_id');
        $validateUser =validator::make(
            $request->all(),
              [
                'productId'      => 'required|numeric',
              ]
          );
        if($validateUser->fails()){
            return response()->json([
              'ststus' => false,
              'message'=>'Validation Error Is',
              'errors' =>$validateUser->errors()->all(),
            ],401);
        }else{
          $show_cart_product          = product::where('id',$request->productId)->get();
          $product_ratting            = product_reviews::where('product_id',$request->productId)->get();
          $product_ratting_count = $product_ratting->count();

          return response()->json([
            'show_cart_product'     => $show_cart_product,
            'product_ratting'       => $product_ratting,
            'product_ratting_count' => $product_ratting_count,
          ]);
        }
      }else{

      }
    }
    //add addquantity
    public function quantity(request $request){
      $validateUser =validator::make(
          $request->all(),
            [
              'cartid'           => 'required|numeric',
              'addquantitynum'   => 'required|numeric',
            ]
        );
      if($validateUser->fails()){
          return response()->json([
            'ststus' => false,
            'message'=>'Validation Error Is',
            'errors' =>$validateUser->errors()->all(),
          ],401);
      }else{
         $carts = crats::where('id',$request->cartid)->first();
         $carts->update([
          'quantity'=>$request->addquantitynum,
        ]);

        $contity  = crats::where('id',$request->cartid)->get();
        return response()->json([
          'ststus' => true,
          'message'=>'product updata Successfull',
          'user' =>$contity,
        ],200);

      }
    }
    //chackoutfetch
    public function chackoutIndex(Request $request){
      $ids = $request->input('ids');

      if (is_string($ids)) {
        $id = explode(',', $ids);
      }

      if (empty($ids)) {
        return response()->json(['products' => []]);
      }



      $products  = crats::whereIn('id',$id)->get();
      return response()->json([
        'products'   => $products,
      ],200);

    }

    //carts deletes section

    public function delete(Request $request){
      $ids = $request->input('ids');
      if (is_string($ids)) {
        $id = explode(',', $ids);
      }
      $ipAddress = request()->ip();

      $cartsdelete =  crats::where('ipAddress',$ipAddress)->whereIn('id',$id)->delete();

      //$products  = DB::table('carts')->whereIn('id',$id)->get();
      return response()->json([
        'cartsdelete'   => $cartsdelete,
      ]);
    }

    //insert order

    public function orderCreate(Request $request){
      $ids = $request->input('ids');
        if (is_string($ids)) {
          $id = explode(',', $ids);
        }

      if (session()->has('user_id')) {
        $userid = session('user_id');

          $carts =crats::where('user_id',$userid)->where('status','Ordered')->first();
          if ($carts) {
            $carts->update([
              'status'      => 'Active',
            ]);
          }

          $cartsdelete =DB::table('carts')->where('user_id',$userid)->whereIn('id',$id)->update([
            'status'      => 'Ordered',
          ]);

      } else {
        return response()->json([
          'ststus' => false,
          'message'=>'let’s try again 🙂',
        ],401);
      }
    }


}
