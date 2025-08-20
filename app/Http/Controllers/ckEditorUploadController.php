<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers; // Pastikan namespace helper Anda sudah benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting: Import facade Storage

class ckEditorUploadController extends Controller
{
    public function uploadCkeditorImage(Request $request)
    {
        // Validasi input
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file
        ]);

        if ($request->hasFile('upload')) {
            // Panggil helper Anda untuk menyimpan gambar.
            // Helper ini mengembalikan PATH RELATIF di dalam disk 'public'.
            $relativePath = Helpers::storeImage($request->file('upload'), 'ckeditorimage');

            // Konversi PATH RELATIF tloersebut menjadi URL LENGKAP yang dapat diakses browser.
            // Storage::url() akan secara otomatis menambahkan APP_URL/storage/ di depannya.
            $fullUrl = Storage::url($relativePath);

            // Kembalikan URL LENGKAP dalam format yang diharapkan CKEditor.
            return response()->json(['url' => $fullUrl]);
        }

        // Jika tidak ada file yang diunggah
        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
