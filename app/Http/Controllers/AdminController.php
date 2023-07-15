<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }
    public function userUpdate(Request $request)
    {
        $user = User::find(request('user_id'));
        $columns = Schema::getColumnListing($user->getTable());
        $updateArray = array_intersect_key($request->all(), array_flip($columns));
        $user->update($updateArray);
        return  response()->json(['success' => 'User Updated'],200);
    }
}
