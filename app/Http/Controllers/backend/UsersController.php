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
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::get();
        $title = "Users List";

        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');

        $query = User::with('roles')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $user = $query->paginate($perPage)->withQueryString();

        return view('backend.users.index', compact('roles', 'user', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Users";
        $role = Role::get();
        return view('backend.users.add', compact('title', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'confirmed', Password::min(8)],
                'user_role' => ['required', 'string'],
                'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10048'],
            ]);

            DB::beginTransaction();

            try {
                $userData = [
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make($validatedData['password']),
                ];

                if ($request->hasFile('image')) {
                    $userData['image'] = Helpers::storeImage($request->file('image'), 'users');
                }

                $user = User::create($userData);
                $user->assignRole($validatedData['user_role']);

                DB::commit();
                return redirect()->route('backend.users.index')->with('success', 'User: ' . $validatedData['name'] . ' Berhasil Ditambah!');

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error creating user: ' . $e->getMessage());

                return redirect()->back()
                    ->with('error', 'Failed to create user. Please try again.')
                    ->withInput();
            }
        }

    /**
     * Show the form for editing the specified resource.
     */
      public function edit($id)
      {
          $title = "Edit User";
          $user = User::with('roles')->findOrFail($id);
          $roles = Role::get();
          return view('backend.users.edit', compact('user', 'roles', 'title'));
      }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
            $validatedData = $request->validate([
                'name' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable', 'string', 'email', 'max:255'],
                'password' => ['nullable', 'string', 'confirmed', Password::min(8)],
                'user_role' => ['nullable', 'string'],
                'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10048'],
            ]);

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

        return redirect()->route('backend.users.index')->with('success', 'User: ' . $validatedData['name'] . ' Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $user = User::findOrFail($id);
      $user->delete();
      return redirect()->route('backend.users.index')->with('success', 'User: '. $user->name . ' Berhasil Dihapus');
    }
}
