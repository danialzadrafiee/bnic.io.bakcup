<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ballot()
    {
        return $this->belongsTo(Ballot::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
