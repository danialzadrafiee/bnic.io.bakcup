<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;
use Log;
use Str;

class User extends Authenticatable
{



    public function corporations(): BelongsToMany
    {
        return $this->belongsToMany(Corporation::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class, 'corporation_id');
    }
    public function signcerts()
    {
        return $this->hasMany(SignCert::class);
    }
    public function nfts()
    {
        return $this->hasMany(Nft::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function trusters()
    {
        return $this->belongsToMany(User::class, 'user_trust', 'trusted_id', 'truster_id')
            ->withTimestamps();
    }

    public function trusteds()
    {
        return $this->belongsToMany(User::class, 'user_trust', 'truster_id', 'trusted_id')
            ->withTimestamps();
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function ballots()
    {
        return $this->belongsToMany(Ballot::class, 'ballot_users');
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function petitions()
    {
        return $this->belongsToMany(Petition::class)->withPivot('user_role')->withTimestamps();
    }

    public function getFullNameAttribute()
    {
        return $this->user_type == 'individual' ? $this->first_name . ' ' . $this->last_name : $this->corp_name;
    }
}
