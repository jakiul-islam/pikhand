<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

use App\Models\order;
use App\Models\User;
use App\Models\order_item;
use App\Models\payments;
use App\Models\crats;
use App\Models\Admin\product;


class DashboardController extends Controller
{
   // dashboord
  public function dashboord(){
    $users = User::select(DB::raw('DATE(updated_at) as date'), DB::raw('COUNT(*) as total'))
      ->groupBy('date')
      ->orderBy('date', 'ASC')
      ->get();

    // Google Chart-এর জন্য ডেটা ফরম্যাট করা
    $userData = [['Date', 'Registrations']];
    foreach ($users as $user) {
      $userData[] = [$user->date, (int)$user->total];
    }
  
  
    $orders = order::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
      ->groupBy('date')
      ->orderBy('date', 'ASC')
      ->get();

    // Google Chart-এর জন্য ডেটা ফরম্যাট করা
    $orderData = [['Date', 'Orders']];
    foreach ($orders as $order) {
      $orderData[] = [$order->date, (int)$order->total];
    }
  
  
    $orderproducts = order_item::join('products', 'order_item.product_id', '=', 'products.id')
      ->select('products.name', DB::raw('SUM(order_item.quantity) as total_sold'))
      ->groupBy('products.name')
      ->orderByDesc('total_sold')
      ->limit(10) // শীর্ষ ১০টি প্রোডাক্ট
      ->get();

    // ✅ Google Chart এর জন্য ডেটা তৈরি করা
    $orderproductData = [['Product', 'Sold']];
    foreach ($orderproducts as $orderproductsrow) {
        $orderproductData[] = [$orderproductsrow->name, (int)$orderproductsrow->total_sold];
    }

    $products = product::select('name', 'stock')
      ->get();

    // Google Charts জন্য ডেটা ফরম্যাট
    $productData = [['Product', 'Stock']]; // header row
    foreach ($products as $product) {
        $productData[] = [$product->name, (int)$product->stock];
    }

    $sales = payments::select(
      DB::raw('DATE(created_at) as date'),
      DB::raw('SUM(amount) as total')
    )
    ->groupBy('date')
    ->orderBy('date', 'asc')
    ->get();

    // Google Charts জন্য ডেটা ফরম্যাট
    $salesData = [['Date', 'Sales']]; // header row
    foreach ($sales as $sale) {
        $salesData[] = [$sale->date, (float)$sale->total];
    }
    
    
    $cartUsers = crats::select(
      DB::raw('DATE(created_at) as date'),
      DB::raw('COUNT(DISTINCT user_id) as users_count')
    )
    ->whereIn('status', ['Active', 'Ordered'])
    ->groupBy('date')
    ->orderBy('date', 'asc')
    ->get();

    // Google Charts জন্য ডেটা ফরম্যাট
    $chartData = [['Date', 'Users']];
    foreach ($cartUsers as $item) {
        $chartData[] = [$item->date, (int)$item->users_count];
    }

    return view('admin.dashboard.dashboard', [
      'userData'          => $userData,
      'orderData'         => $orderData,
      'orderproductData'  => $orderproductData,
      'productData'       => $productData,
      'salesData'         => $salesData,
      'chartData'         => $chartData,
    ]);
  }
  
  public function process_order(request $request){
      
    $orders = order::with(['User', 'payments'])->where('status', 'processing')
      ->where('created_at', '<', Carbon::now()->subHours(24))
      ->orderBy('id', 'desc')
      ->get();


        
      $orderCount = $orders->count();
      
      return response()->json([
        'status'     => true,
        'order'      => $orders,
        'orderCount' => $orderCount,
      ],200);
  }
    
  public function productStokLimit(request $request){
    $products = product::orderBy('stock','asc')
      ->get();


    return response()->json([
      'status'     => true,
      'products'      => $products,
    ],200);
      
  }
    
  public function updateStockLimit(request $request){
    
    $products = product::where('id',$request->productid)
      ->update([
        'stock' => $request->updateStok,
      ]);


    return response()->json([
      'status'     => true,
      'message'      => 'Product stock update successfull',
    ],200);
      
  }
    
    //New order
    
  public function NewOrder(request $request){
    
        
    $orders = order::with(['User', 'payments'])
      ->where('status', 'processing')
      ->orderBy('id', 'desc')
      ->get();

        
        
        
    $orderCount = $orders->count();
      
    return response()->json([
      'status'     => true,
      'time'       => Carbon::now()->subHours(24),
      'order'      => $orders,
      'orderCount' => $orderCount,
    ],200);
      
  }
}




