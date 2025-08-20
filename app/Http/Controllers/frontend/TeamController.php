<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Position;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        // 1. Ambil semua divisi, diurutkan berdasarkan kolom 'order'
        // Eager load jabatans top-level (parent_id = null) yang terhubung ke divisi ini,
        // serta anak-anak jabatan dan anggota tim mereka.
        $divisions = Division::orderBy('order')
                             ->with(['jabatans' => function($query) {
                                 $query->whereNull('parent_id')
                                       ->with(['children', 'members']); // children akan rekursif memuat members
                             }])
                             ->get();

        // 2. Ambil jabatan top-level yang tidak memiliki divisi
        $jabatansWithoutDivision = Position::whereNull('parent_id')
                                            ->whereNull('division_id')
                                            ->with(['children', 'members'])
                                            ->orderBy('order')
                                            ->get();

        // Sekarang kita langsung melewatkan $divisions dan $jabatansWithoutDivision ke view
        return view('frontend.team.index', compact('divisions', 'jabatansWithoutDivision'));
    }
}
