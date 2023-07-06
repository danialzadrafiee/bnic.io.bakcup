<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubCatRequest;
use App\Http\Requests\UpdateSubCatRequest;
use App\Models\SubCat;

class SubCatController extends Controller
{
    public function select($sub_cat_id)
    {
        return SubCat::find($sub_cat_id);
    }
}
