<?php

namespace App\Http\Controllers\API_Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image as ImageModel;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function __invoke(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('images')) {
            $array_filenames = '';
            $response = [
                "status" => 201,
                "message" => "",
                "timestamp" => time(),
                "files" => [],

            ];
            foreach ($request->file('images') as $uploadedFile) {
                $filename = $uploadedFile->getClientOriginalName();
                $array_filenames .= $filename . ' ';
                $this->AddToDB($filename, $uploadedFile);
                $fileData = [
                    "filename" => $filename,
                    "url" => asset('file/') . '/' . 'uploads/' . $filename,
                ];
                $response['files'][] = $fileData;
            }
            $response['message'] = 'Images ' . "'" . $array_filenames . "' " . 'uploaded successfully';
            return response()->json($response);
        } else {
            return response()->json(['error' => 'Files not found.Upload images, please'], 400);
        }
    }
    protected function AddToDB($filename, $uploadedFile)
    {
        $isImageModel = ImageModel::where('filename', $filename);
        if ($isImageModel->exists()) {
            $path = $uploadedFile->storeAs('uploads', $uploadedFile->getClientOriginalName());
            $manager = new ImageManager(new Driver());
            $image = $manager->read(Storage::disk('public')->get($path));
            if ($image->width() > 512 || $image->height() > 512) {
                $image->cover(512, 512);
            }
            $image->save(Storage::path('/public/' . $path), 80);
            ImageModel::where('filename', $filename)->update([
                'updated_at' => now(),
                'type' =>  $uploadedFile->getClientMimeType(),
                'size' =>  $uploadedFile->getSize(),
                'url' => asset('file/') . '/' . $path
            ]);
        } else {
            $path = $uploadedFile->storeAs('uploads', $uploadedFile->getClientOriginalName(), 'public');
            $manager = new ImageManager(new Driver());
            $image = $manager->read(Storage::disk('public')->get($path));
            $isImageTrashed = ImageModel::withTrashed()->where('filename', $filename)->get()->first();
            if ($isImageTrashed) {
                $isImageTrashed->restore();
            } else {
                ImageModel::create([
                    'filename' => $filename,
                    'url' => asset('file/') . '/' . $path,
                    'type' => $uploadedFile->getClientMimeType(),
                    'size' => $uploadedFile->getSize(),
                ]);
            }
            if ($image->width() > 512 || $image->height() > 512) {
                $image->cover(512, 512);
            }
            $image->save(Storage::path('/public/' . $path), 80);
        }
    }
}