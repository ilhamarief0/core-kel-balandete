<?php

namespace App\Http\Controllers\backend;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Models\Position;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{

    public function dataTable(Request $request)
      {
        if ($request->ajax()) {
            try {
                $data = Team::query()->with('position');

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
                    ->addColumn('profile', function ($row) {
                        $profileHtml = '<div class="d-flex align-items-center">';
                        if ($row->image) {
                            $profileHtml .= '
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-4">
                                    <div class="symbol-label" style="height: 60px; width: 60px;">
                                        <img src="'. asset('storage/' . $row->image) .'"
                                            alt="Profile"
                                            style="object-fit: cover; object-position: top; height: 100%; width: 100%; border-radius: 50%;" />
                                    </div>
                                </div>';
                        } else {
                            $profileHtml .= '
                                <div class="symbol symbol-50px me-5">
                                    <div class="symbol-label fs-2 fw-semibold text-success">'. strtoupper(substr($row->name, 0, 1)) .'</div>
                                </div>';
                        }
                        $profileHtml .= '
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">'. e($row->name) .'</a>
                            </div>
                        </div>';
                        return $profileHtml;
                    })
                    ->addColumn('position', function ($row) {
                        if ($row->position) {
                            return '<span class="badge badge-light-primary">' . $row->position->name . '</span>';
                        }
                        return '<span class="badge badge-light-secondary">N/A</span>'; // Fallback if position is null
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
                                    <a href="#" class="menu-link px-3 edit-user-btn" data-id="'. $row->id .'">Edit</a>
                                </div>
                                <div class="menu-item px-3">
                                   <a href="#" class="menu-link px-3 delete-user" data-id="'. $row->id .'">Delete</a>
                                </div>
                            </div>
                        </div>';
                    })
                    ->rawColumns(['profile', 'position', 'actions'])
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
        $position = Position::all();
        return view('backend.team.index', compact('position'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $validatedData = $request->validated();
        $path = null;

        if ($request->hasFile('image')) {
            $path = Helpers::storeImage($request->file('image'), 'team');
        }

        DB::beginTransaction();

        try {
            Team::create([
                'name' => $validatedData['name'],
                'instagram' => $validatedData['instagram'],
                'facebook' => $validatedData['facebook'],
                'x' => $validatedData['x'],
                'image' => $path,
                'id_position' => $validatedData['id_position'],
            ]);

            DB::commit();
            return response()->json(['message' => 'User Store Success', 'status' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Error Stored User: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error creating user: ' . $e->getMessage()]);
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
        //
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
