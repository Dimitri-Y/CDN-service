<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;

class ImageAllController extends Controller
{
    public function __invoke(Request $request)
    {
        // $images = Image::simplePaginate(10);
        // if ($request->ajax()) {
        //     return view('image.one_image', compact('images'));
        // }
        $images = Image::all();
        return view('image.all_images', compact('images'));
    }
}