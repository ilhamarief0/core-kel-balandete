<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Throwable;


class ContactUsController extends Controller
{
    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = ContactUs::query();

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
                    ->editColumn('created_at', function ($row) {
                        return $row->created_at->format('d M Y');
                    })
                    ->addColumn('actions', function ($row) {
                        $encryptedId = Crypt::encryptString($row->id);
                        $viewRoute = route('backend.contactus.edit', ['contactu' => $encryptedId]);
                        return '
                            <div class="text-end">
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    Actions
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a href="' . $viewRoute . '" class="menu-link px-3">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>';
                    })
                    ->rawColumns(['actions'])
                    ->make(true);

            } catch (Throwable $e) {
                return response()->json([
                    'error' => 'Server error: ' . $e->getMessage()
                ], 500);
            }
        }
        abort(403, 'Unauthorized action.');
    }


    public function markAsRead()
    {
      ContactUs::where('is_read', false)->update(['is_read' => true]);
      return response()->json(['success' => true, 'message' => 'Notifications marked as read.']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.contactus.index');
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
    public function edit(string $contactu)
    {
          $id = Crypt::decryptString($contactu);
          $contactusEdit = ContactUs::findOrFail($id);
          return view('backend.contactus.view', compact('contactusEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
