<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // each category has one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subCats()
    {
        return $this->belongsToMany(SubCat::class, 'category_sub_cats', 'category_id', 'sub_cat_id');
    }
}
