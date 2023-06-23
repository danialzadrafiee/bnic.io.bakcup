<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Corporation extends Model
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function documents() 
    {
        return $this->hasMany(Document::class);
    }
}
