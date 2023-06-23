<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // each category has one user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
