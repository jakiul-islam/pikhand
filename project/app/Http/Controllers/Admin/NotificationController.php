<?php

namespace App\Http\Controllers\Admin;

use App\Services\FirebaseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class NotificationController extends Controller
{
    public function send(request $request , FirebaseService $firebase)
    {


      
        $response = $firebase->sendNotification(
            $request->token,
            'Pikhand',
            'A new product add and 50 % off this product ',
        );

        return response()->json([
            'success' => $response->successful(),
            'response' => $response->json(),
        ]);
    }
}