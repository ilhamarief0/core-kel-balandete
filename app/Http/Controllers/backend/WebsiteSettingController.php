<?php

namespace App\Http\Controllers\backend;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebsiteSettingUpdateRequest;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Website Setting';
        $setting = WebsiteSetting::find(1);
        return view('backend.websiteSetting.index', compact('title', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function getData()
    {
         $id = WebsiteSetting::find(1);
         try {
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Website',
                'data' => $id,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching user data: ' . $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WebsiteSettingUpdateRequest $request)
    {

      // dd($request->all());
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $websiteSetting = WebsiteSetting::firstOrNew([]);
            $websiteSetting->website_name = $validatedData['website_name'];
            $websiteSetting->website_description = $validatedData['website_description'];
            $websiteSetting->website_address = $validatedData['website_address'];
            $websiteSetting->website_phone = $validatedData['website_phone'];
            $websiteSetting->website_email = $validatedData['website_email'];
            $websiteSetting->website_instagram = $validatedData['website_instagram'];
            $websiteSetting->website_x = $validatedData['website_x'];
            $websiteSetting->website_facebook = $validatedData['website_facebook'];
            $websiteSetting->website_youtube = $validatedData['website_youtube'];

            if ($request->hasFile('website_logo')) {
                if ($websiteSetting->website_logo && Storage::disk('public')->exists($websiteSetting->website_logo)) {
                    Storage::disk('public')->delete($websiteSetting->website_logo);
                }
                $path = Helpers::storeImage($request->file('website_logo'), 'websiteSetting');
                $websiteSetting->website_logo = $path;
            }
            $websiteSetting->save();

            DB::commit();
            return back()->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error creating user: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
