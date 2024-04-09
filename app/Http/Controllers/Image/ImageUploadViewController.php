<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;

class ImageUploadViewController extends Controller
{
    public function __invoke()
    {
        return view('image.upload_images');
    }
}