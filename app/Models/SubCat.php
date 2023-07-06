<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCat extends Model
{

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_sub_cats', 'sub_cat_id', 'category_id');
    }
}
