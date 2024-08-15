<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $image = $request->file('upload');
            $path = $image->store('images', 'public'); // Lưu vào thư mục storage/app/public/images
    
            $url = Storage::url($path);
    
            // CKEditor yêu cầu trả về định dạng JSON như sau:
            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }
    
        return response()->json([
            'uploaded' => false,
            'error' => ['message' => 'No image uploaded']
        ]);
    }
    
}