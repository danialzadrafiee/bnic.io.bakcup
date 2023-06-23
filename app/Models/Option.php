<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public function ballot()
    {
        return $this->belongsTo(Ballot::class);
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
