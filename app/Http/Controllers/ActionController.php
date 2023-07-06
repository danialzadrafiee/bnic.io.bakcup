<?php

namespace App\Http\Controllers;

use App\Models\Corporation;
use App\Models\User;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function search_invi_by_name(Request $request)
    {
        $query = $request->query;
        $users = User::where('first_name', 'LIKE', '%' . $query . '%')
            ->orWhere('last_name', 'LIKE', '%' . $query . '%')
            ->orWhere('email', 'LIKE', '%' . $query . '%')
            ->where('user_type', 'invidual')->get();
        return response()->json($users);
    }
    public function search_corp_by_name(Request $request)
    {
        $query = $request->query;
        $corporations = User::where('corp_name', 'LIKE', '%' . $query . '%')
            ->get();
        return response()->json($corporations);
    }
}
