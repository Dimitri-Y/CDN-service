<?php

namespace App\Http\Controllers\Image;

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
            foreach ($request->file('images') as $uploadedFile) {
                $filename = $uploadedFile->getClientOriginalName();
                $array_filenames .= $filename . ' ';
                $this->AddToDB($filename, $uploadedFile);
            }
            session()->flash('success', 'Images ' . $array_filenames . 'uploaded successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Upload images, please');
            return redirect()->back();
        }
    }
    protected function AddToDB($filename, $uploadedFile)
    {

        if (ImageModel::where('filename', $filename)->exists()) {
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
            if ($image->width() > 512 || $image->height() > 512) {
                $image->cover(512, 512);
            }
            $image->save(Storage::path('/public/' . $path), 80);
            ImageModel::create([
                'filename' => $filename,
                'url' => asset('file/') . '/' . $path,
                'type' => $uploadedFile->getClientMimeType(),
                'size' => $uploadedFile->getSize(),
            ]);
        }
    }
}