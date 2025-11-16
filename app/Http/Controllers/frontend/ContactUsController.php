<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactUsController extends Controller
{

  public function index()
  {
    $title = "Contactus";
    return view('frontend.contactus.index', compact('title'));
  }

    public function submit(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required',
                'category' => 'required|string|max:255',
                'message' => 'required|string',
                'report_proof' => 'required'
            ]);

            $contactData = [
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'category' => $validatedData['category'],
                'message' => $validatedData['message'],
            ];

            if ($request->hasFile('report_proof')) {
                $contactData['report_proof'] = Helpers::storeImage($request->file('report_proof'), 'report_proof');
            }

            ContactUs::create($contactData);

            Session::flash('success', 'Berhasil Mengirim Laporan!');
            return redirect()->route('contactus.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Session::flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return back()->withInput();
        }
    }
}
