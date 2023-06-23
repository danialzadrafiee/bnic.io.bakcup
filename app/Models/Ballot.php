<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ballot extends Model
{
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'ballot_users')->withPivot('candidate');
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
