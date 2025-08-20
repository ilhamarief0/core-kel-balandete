<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class PositionController extends Controller
{
    public function index()
    {
        // Ambil semua divisi, diurutkan berdasarkan kolom 'order'
        $divisions = Division::orderBy('order')->get();

        // Ambil semua jabatan top-level (parent_id = null) yang tidak memiliki divisi
        // Ini akan menjadi bagian "Jabatan Tanpa Divisi"
        $jabatansWithoutDivision = Position::whereNull('parent_id')
                                            ->whereNull('division_id') // Filter yang tidak punya divisi
                                            ->with(['children', 'division'])
                                            ->orderBy('order')
                                            ->get();

        // Ambil semua jabatan untuk dropdown parent di modal
        $allJabatans = Position::orderBy('name')->get();

        // Mengirimkan data ke view
        return view('backend.positions.index', compact('divisions', 'jabatansWithoutDivision', 'allJabatans'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'parent_id' => 'nullable|exists:jabatans,id',
                'division_id' => 'nullable|exists:divisions,id',
            ]);

            $maxOrder = Position::where('parent_id', $validatedData['parent_id'])->max('order');
            $newOrder = ($maxOrder !== null) ? $maxOrder + 1 : 0;

            Position::create([
                'name' => $validatedData['name'],
                'parent_id' => $validatedData['parent_id'],
                'division_id' => $validatedData['division_id'],
                'order' => $newOrder,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Jabatan berhasil ditambahkan!']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error adding jabatan: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menambahkan jabatan.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $jabatan = Position::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'parent_id' => 'nullable|exists:jabatans,id',
                'division_id' => 'nullable|exists:divisions,id',
            ]);

            $jabatan->update([
                'name' => $validatedData['name'],
                'parent_id' => $validatedData['parent_id'],
                'division_id' => $validatedData['division_id'],
            ]);

            return response()->json(['status' => 'success', 'message' => 'Jabatan berhasil diperbarui!']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating jabatan: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat memperbarui jabatan.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $jabatan = Position::findOrFail($id);

            if ($jabatan->children()->count() > 0) {
                return response()->json(['error' => 'Tidak bisa menghapus jabatan ini karena memiliki sub-jabatan.'], 409);
            }

            $jabatan->delete();

            return response()->json(['status' => 'success', 'message' => 'Jabatan berhasil dihapus!']);
        } catch (\Exception $e) {
            Log::error('Error deleting jabatan: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus jabatan.'], 500);
        }
    }

    // Metode untuk memperbarui urutan JABATAN
    public function updateOrder(Request $request)
    {
        try {
            // Menggunakan request()->json('data') untuk membaca payload JSON
            $data = $request->json('data');
            // Pastikan data adalah array, jika tidak, inisialisasi sebagai array kosong
            if (!is_array($data)) {
                $data = [];
            }
            $this->parseJabatanJsonAndSave($data);

            return response()->json(['status' => 'success', 'message' => 'Urutan jabatan berhasil diperbarui!']);
        } catch (\Exception $e) {
            Log::error('Error updating jabatan order: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memperbarui urutan jabatan.'], 500);
        }
    }

    private function parseJabatanJsonAndSave($array, $parent_id = null)
    {
        foreach ($array as $index => $item) {
            $jabatan = Position::find($item['id']);
            if ($jabatan) {
                $jabatan->parent_id = $parent_id;
                $jabatan->order = $index;
                $jabatan->save();

                if (isset($item['children'])) {
                    $this->parseJabatanJsonAndSave($item['children'], $jabatan->id);
                }
            }
        }
    }

    // Metode untuk memperbarui urutan DIVISI
    public function updateDivisionOrder(Request $request)
    {
        try {
            // Menggunakan request()->json('data') untuk membaca payload JSON
            $data = $request->json('data');
            // Pastikan data adalah array, jika tidak, inisialisasi sebagai array kosong
            if (!is_array($data)) {
                $data = [];
            }
            $this->parseDivisionJsonAndSave($data);

            return response()->json(['status' => 'success', 'message' => 'Urutan divisi berhasil diperbarui!']);
        } catch (\Exception $e) {
            Log::error('Error updating division order: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memperbarui urutan divisi.'], 500);
        }
    }

    private function parseDivisionJsonAndSave($array)
    {
        foreach ($array as $index => $item) {
            $division = Division::find($item['id']);
            if ($division) {
                $division->order = $index;
                $division->save();
            }
        }
    }
}
