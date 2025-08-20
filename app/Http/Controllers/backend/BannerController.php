<?php

namespace App\Http\Controllers\backend;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteBannerRequest;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = Banner::query();

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

                 ->addColumn('is_active', function ($row){
                      $isactive = [$row->is_active];
                          $isActiveColor = [
                              'yes' => 'badge-light-primary',
                              'no'        => 'badge-light-info',
                          ];
                       return Helpers::getBadges($isactive ,$isActiveColor, 'badge-light-secondary');
                  })

                    ->editColumn('created_at', function ($row) {
                        return $row->created_at->format('d M Y');
                    })

                    ->addColumn('actions', function ($row) {
                        return '
                        <div class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                Actions
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 edit-banner-btn" data-id="'. $row->id .'">Edit</a>
                                </div>
                                <div class="menu-item px-3">
                                   <a href="#" class="menu-link px-3 delete-banner" data-id="'. $row->id .'">Delete</a>
                                </div>
                            </div>
                        </div>';
                    })

                    ->rawColumns(['images', 'is_active' ,'actions'])
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
        return view('backend.banner.index');
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
    public function store(StoreBannerRequest $request)
    {
        $validatedData = $request->validated();
        $path = null;

        if ($request->hasFile('image')) {
            $path = Helpers::storeImage($request->file('image'), 'banner');
        }

        DB::beginTransaction();

        try {
             Banner::create([
                'image' => $path,
                'title' => $validatedData['title'],
                'is_active' => $validatedData['is_active'],
            ]);

            DB::commit();
            return response()->json(['message' => 'Banner Store Success', 'status' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Error Stored Banner: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error creating banner: ' . $e->getMessage()]);
        }
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
    public function edit(string $id)
    {
          $banner = Banner::findOrFail($id);
          return response()->json([
              'banner' => $banner,
          ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, string $id)
    {
        $banner = Banner::findOrFail($id);

        $validatedData = $request->validated();

        $banner->title = $validatedData['title'];
        $banner->is_active = $validatedData['is_active'];

        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $path = Helpers::storeImage($request->file('image'), 'banner');
            $banner->image = $path;
        }

        $banner->save();

        return response()->json(['status' => 'success', 'message' => 'Banner updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(DeleteBannerRequest $request)
    {
        $validatedData = $request->validated();
        try {
            DB::beginTransaction();
            $deletedBannerCount = 0;
            foreach ($validatedData['ids'] as $bannerId) {
                $banner = Banner::findOrFail($bannerId);
                if ($banner->image && file_exists(storage_path('app/public/' . $banner->image))) {
                    Storage::disk('public')->delete($banner->image);
                }
                $banner->delete();
                $deletedBannerCount++;
            }
            DB::commit();
            $message = $deletedBannerCount > 1 ? "Selected banner have been deleted successfully." : "Banner has been deleted successfully.";
            return response()->json(['message' => $message, 'status' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Banner Bulk Delete Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete selected banner: ' . $e->getMessage(), 'status' => 'error'], 500);
        }
    }
}
