<?php

namespace App\Http\Controllers\backend;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteNewsRequest;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
      public function dataTable(Request $request)
     {
        if ($request->ajax()) {
            try {
                $data = News::query();

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
                      $editRoute = route('backend.news.edit', ['news' => $encryptedId]);
                        return '
                        <div class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                Actions
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="'. $editRoute .'" class="menu-link px-3 edit-user-btn">Edit</a>
                                </div>
                                <div class="menu-item px-3">
                                   <a href="#" class="menu-link px-3 delete-user" data-id="'. $row->id .'">Delete</a>
                                </div>
                            </div>
                        </div>';
                    })

                    ->rawColumns(['images', 'roles' ,'actions'])
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
        return view('backend.news.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsStoreRequest $request)
    {
        $validatedData = $request->validated();
        // $path = null;
        if ($request->hasFile('image')) {
            $path = Helpers::storeImage($request->file('image'), 'news');
        }

        DB::beginTransaction();

        try {
            $news = new News();
            $news->title = $validatedData['title'];
            $news->image = $path;
            $news->content = $validatedData['content'];
            $news->save();

            DB::commit();
            Session::flash('success_message', 'Successfully Store News');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error creating user: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $news)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $news)
    {
          $id = Crypt::decryptString($news);
          $newsEdit = News::findOrFail($id);
          return view('backend.news.edit', compact('newsEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, string $news)
    {
        $validatedData = $request->validated();
        $id = Crypt::decryptString($news);

        $news = News::findOrFail($id);
        $news->title = $validatedData['title'];
        if ($request->hasFile('image')) {
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $path = Helpers::storeImage($request->file('image'), 'news');
            $news->image = $path;
        }
        $news->content = $validatedData['content'];
        $news->save();
        Session::flash('success_message', 'News ' . $news->title . ' Updated Successfully!');
        return response()->json(['message' => 'News updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(DeleteNewsRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $deletedNewsCount = 0;
            foreach ($validatedData['ids'] as $newsId) {
                $news = News::findOrFail($newsId);
                if ($news->image && file_exists(storage_path('app/public/' . $news->image))) {
                    Storage::disk('public')->delete($news->image);
                }
                $news->delete();
                $deletedNewsCount++;
            }

            DB::commit();
            $message = $deletedNewsCount > 1 ? "Selected News have been deleted successfully." : "News has been deleted successfully.";
            return response()->json(['message' => $message, 'status' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User Bulk Delete Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete selected news: ' . $e->getMessage(), 'status' => 'error'], 500);
        }
    }
}
