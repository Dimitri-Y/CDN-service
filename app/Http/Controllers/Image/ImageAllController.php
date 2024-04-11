<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;

class ImageAllController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('image.all_images');
    }
}