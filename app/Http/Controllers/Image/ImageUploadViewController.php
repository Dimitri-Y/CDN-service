<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;

class ImageUploadViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function __invoke()
    {
        return view('image.upload_images');
    }
}