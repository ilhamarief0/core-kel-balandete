<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

  protected $guarded = [];

    public function position()
    {
      return $this->belongsTo(Position::class, 'id_position');
    }
}
