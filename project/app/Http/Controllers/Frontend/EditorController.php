<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function index()
    {
        return view('your_view'); // Blade ফাইলের নাম দিন
    }

    public function store(Request $request)
    {
        $content = $request->input('content');
        return response()->json(['message' => 'Content received!', 'content' => $content]);
    }
}