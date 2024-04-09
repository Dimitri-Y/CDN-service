<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;

class ImageFileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke(Request $request, $path)
    {
        $path = str_replace('\\', '/', $path);
        $filePath = storage_path('app/public/' . $path);
        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }
}