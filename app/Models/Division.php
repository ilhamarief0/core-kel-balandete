<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
        use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the jabatans for the division.
     */
    public function jabatans()
    {
        return $this->hasMany(Position::class, 'division_id')->orderBy('order');
    }
}
