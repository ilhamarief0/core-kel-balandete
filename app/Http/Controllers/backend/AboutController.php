<?php

namespace App\Http\Controllers\backend;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAboutRequest;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AboutController extends Controller
{

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = About::query();

                if ($search = $request->input('search')) {
                    $data->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
                }

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id', function ($row) {
                        return $row->id;
                    })
                    ->addColumn('images', function ($row) {
                        return '
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px overflow-hidden me-4">
                                            <a href="#">
                                                <div class="symbol-label" style="height: 60px; width: 60px; border-radius: 0;">
                                                    <img src="'. asset('storage/' . $row->image) .'" alt="Profile" style="object-fit: cover; object-position: top; height: 100%; width: 100%; border-radius: 0;" />
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                ';
                    })
                    ->editColumn('created_at', function ($row) {
                        return $row->created_at->format('d M Y');
                    })
                    ->addColumn('actions', function ($row) {
                        $encryptedId = Crypt::encryptString($row->id);
                        $editRoute = route('backend.about.edit', ['about' => $encryptedId]);
                        return '
                        <div class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                Actions
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="'. $editRoute .'" class="menu-link px-3 edit-user-btn">Edit</a>
                                </div>
                            </div>
                        </div>';
                    })
                    ->rawColumns(['images' ,'actions'])
                    ->make(true);
            } catch (\Throwable $e) {
                return response()->json([
                    'error' => 'Server error: ' . $e->getMessage()
                ], 500);
            }
        }
        abort(403, 'Unauthorized action.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.about.index');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $about)
    {
        $id = Crypt::decryptString($about);
        $aboutEdit = About::findOrFail($id);
        if ($aboutEdit->view === 'landingpage') {
            return view('backend.about.edit.landingpage', compact('aboutEdit'));
        } elseif ($aboutEdit->view === 'aboutdetail') {
            return view('backend.about.edit.aboutdetail', compact('aboutEdit'));
        }
        // return view('backend.about.edit', compact('aboutEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request, string $about)
    {
        $validatedData = $request->validated();
        $id = Crypt::decryptString($about);

        $about = About::findOrFail($id);
        $about->title = $validatedData['title'];
        if ($request->hasFile('image')) {
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            $path = Helpers::storeImage($request->file('image'), 'about');
            $about->image = $path;
        }
        $about->content = $validatedData['content'];
        $about->save();
        Session::flash('success_message', 'About ' . $about->title . ' Updated Successfully!');
        return response()->json(['message' => 'About updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
