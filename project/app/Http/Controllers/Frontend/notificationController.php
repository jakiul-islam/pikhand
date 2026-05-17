<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\notification;

class notificationController extends Controller
{
    public function index(){

        $userid = session('user_id');

        $notification = notification::where('user_id',$userid )->get();

        return response()->json([
          'status' => true,
          'notification' => $notification
        ], 200);
    }
}
