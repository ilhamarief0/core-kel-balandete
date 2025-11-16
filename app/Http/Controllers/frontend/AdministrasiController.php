<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    public function index()
    {
      return view('frontend.administrasi.index');
    }
}
