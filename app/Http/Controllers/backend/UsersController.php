<?php

namespace App\Http\Controllers\backend;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{

  public function __construct()
  {

  }

 public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = User::query()->with('roles'); // Eager load roles to prevent N+1 query issues

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
                        // Corrected the PHP if condition and used $row->name for initials
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
                                <span class="text-muted fs-7">'. e($row->email) .'</span>
                            </div>
                        </div>';
                        return $profileHtml;
                    })
                    ->addColumn('roles', function ($row) {
                        $roles = $row->roles->pluck('name')->toArray();
                        $roleColorMap = [
                            'Administrator' => 'badge-light-primary',
                            'Viewer'        => 'badge-light-info',
                            // Add more roles and their colors as needed
                        ];
                        // Ensure Helpers::getBadges exists and is correctly defined
                        return Helpers::getBadges($roles, $roleColorMap, 'badge-light-secondary');
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
                    ->rawColumns(['profile', 'roles', 'actions'])
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
         $roles = Role::get();
        return view('backend.users.index', compact('roles'));
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
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $path = null;

        if ($request->hasFile('image')) {
            $path = Helpers::storeImage($request->file('image'), 'users');
        }

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'image' => $path,
            ]);

            $user->assignRole($validatedData['user_role']);

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
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
      public function edit($id)
      {
          $user = User::with('roles')->findOrFail($id);
          return response()->json([
              'user' => $user,
              'role' => $user->roles->pluck('name')->first()
          ]);
      }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $validatedData = $request->validated();

        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if (isset($validatedData['password']) && !empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $path = Helpers::storeImage($request->file('image'), 'users');
            $user->image = $path;
        }

        $user->save();
        $user->syncRoles([$validatedData['user_role']]);

        return response()->json(['message' => 'User updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    public function delete(DeleteUserRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();
            $deletedUserCount = 0;
            foreach ($validatedData['ids'] as $userId) {
                $user = User::findOrFail($userId);
                if ($user->image && file_exists(storage_path('app/public/' . $user->image))) {
                    Storage::disk('public')->delete($user->image);
                }
                $user->roles()->detach();
                $user->delete();
                $deletedUserCount++;
            }
            DB::commit();
            $message = $deletedUserCount > 1 ? "Selected users have been deleted successfully." : "User has been deleted successfully.";
            return response()->json(['message' => $message, 'status' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User Bulk Delete Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete selected users: ' . $e->getMessage(), 'status' => 'error'], 500);
        }
    }
}
