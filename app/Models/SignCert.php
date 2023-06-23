<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignCert extends Model
{
    public function corporation(){
        return $this->belongsTo(User::class, 'corporation_id');
    }
}
