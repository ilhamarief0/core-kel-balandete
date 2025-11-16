<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers; // Pastikan namespace helper Anda sudah benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting: Import facade Storage

class ckEditorUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:12048',
        ]);

        if ($request->hasFile('upload')) {
            $relativePath = Helpers::storeImage($request->file('upload'), 'ckeditorimage');

            $url = Storage::url($relativePath);

            $fileName = basename($relativePath);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
