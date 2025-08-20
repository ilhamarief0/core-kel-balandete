<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class ServiceController extends Controller
{
    public function index(string $service)
    {
      // $id = Crypt::decryptString($service);
      // $serviceDetail = Service::findOrFail($id);
      // return view('frontend.service.index', compact('serviceDetail'));


        $titlePossible = Str::of($service)->replace('-', ' ')->title();
        $service = Service::where('title', 'LIKE', '%' . $titlePossible . '%')
                      ->first();

        if (!$service) {
            $services = Service::all();
            $foundService = null;
            foreach ($services as $b) {
                if (Str::slug($b->title) === $service) {
                    $foundBlog = $b;
                    break;
                }
            }
            $service = $foundService;
        }


        if (!$service) {
            abort(404);
        }

        $title = $service->title;

        return view('frontend.service.index', compact('service', 'title'));

    }

}
