<?php

namespace App\Http\Controllers\API_Image;

use App\Http\Controllers\Controller;
use App\Models\Image;

class ImageAllController extends Controller
{
    public function __invoke()
    {
        $images = Image::paginate(10);
        $response = [
            "status" => 200,
            "timestamp" => time(),
            "total" => $images->total(),
            "per_page" => $images->perPage(),
            "current_page" => $images->currentPage(),
            "last_page" => $images->lastPage(),
            "list" => [
                "name" => "uploads",
                "type" => "folder",
                "size" => 30309755,
                "list" => []
            ]
        ];

        foreach ($images as $image) {
            $fileData = [
                "filename" => $image->filename,
                "type" => "file",
                "size" => $image->size,
                "mtime" => $image->updated_at->format('d.m.Y H:i:s'),
                "url" => $image->url
            ];
            $response['list']['list'][] = $fileData;
        }

        return response()->json($response);
    }
}