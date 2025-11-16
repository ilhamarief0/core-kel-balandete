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
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Users List";
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');

        $query = News::latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }
        $news = $query->paginate($perPage)->withQueryString();
        return view('backend.news.index', compact('news', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Berita";
        return view('backend.news.add', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validatedData = $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10048'],
            ]);

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
    public function edit(string $id)
    {
          $title = "Edit Berita";
          $news = News::findOrFail($id);
          return view('backend.news.edit', compact('news', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10048'],
        ]);

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
        return redirect()->route('backend.news.index')->with('success', 'Berhasil Update Berita');
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy(string $id)
     {
      $news = News::findOrfail($id);
      $news->delete();
      return redirect()->route('backend.news.index')->with('success', 'Berhasil Hapus Data Berita');
     }

}
