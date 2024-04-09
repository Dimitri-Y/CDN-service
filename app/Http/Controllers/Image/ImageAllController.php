<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;

class ImageAllController extends Controller
{
    public function __invoke()
    {
        $images = Image::all();
        foreach ($images as $image) {
        }
        return view('image.all_images', compact('images'));
    }
}