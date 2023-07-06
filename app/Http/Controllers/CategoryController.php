<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        return view('category.index.index', compact('user'));
    }
    public function select(Request $request)
    {
        $selected_category = Category::find($request->category_id);
        return ($selected_category);
    }
}
