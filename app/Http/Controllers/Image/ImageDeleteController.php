<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function __invoke(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            $filename = Image::find($id)->filename;
            Storage::delete('uploads/' . $filename);
            Image::where('filename', $filename)->delete();
            return response()->json(['message' => 'File ' . $filename . ' delete succesfully'], 204);
        } else {
            return response()->json(['error' => 'Bad Request.'], 400);
        }
    }
}