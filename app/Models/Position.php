<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'order',
        'division_id',

    ];

    /**
     * Get the parent jabatan.
     */
    public function parent()
    {
        return $this->belongsTo(Position::class, 'parent_id');
    }

    /**
     * Get the child jabatans (including their children recursively).
     */
    public function children()
    {
        // PENTING: Menambahkan ->with('children') di sini agar relasi children juga memuat anaknya
        // Ini memastikan semua level hierarki dimuat secara efisien.
        return $this->hasMany(Position::class, 'parent_id')->with('children')->orderBy('order');
    }

    public function team()
    {
      return $this->hasMany(Team::class, 'id_position');
    }
     public function division() // Tambahkan ini
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

        public function members() // Tambahkan relasi ini
    {
        return $this->hasMany(Team::class, 'id_position');
    }
}
