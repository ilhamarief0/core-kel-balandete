<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\InformasiKelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InformasiKelurahanController extends Controller
{
    public function detail($informasiKelurahan)
    {
        $titlePossible = Str::of($informasiKelurahan)->replace('-', ' ')->title();
        $informasiKelurahan = InformasiKelurahan::where('title', 'LIKE', '%' . $titlePossible . '%')
                      ->first();

        if (!$informasiKelurahan) {
            $informasiKelurahans = InformasiKelurahan::all();
            $foundinformasiKelurahan = null;
            foreach ($informasiKelurahans as $b) {
                if (Str::slug($b->title) === $informasiKelurahan) {
                    $foundBlog = $b;
                    break;
                }
            }
            $informasiKelurahan = $foundinformasiKelurahan;
        }


        if (!$informasiKelurahan) {
            abort(404);
        }

        $title = $informasiKelurahan->title;

        return view('frontend.informasiKelurahan.detail', compact('informasiKelurahan', 'title'));
    }
}
