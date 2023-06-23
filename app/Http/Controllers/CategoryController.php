<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Auth;
use Request;

class CategoryController extends Controller
{
 
    public function index(Request $request)
    {
        $user = Auth::user();
        return view('category.index.index', compact('user'));
    }

}
