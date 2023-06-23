<?php

namespace App\Http\Controllers;

use App\Models\Corporation;
use App\Models\SignCert;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $isOwner = true;
        $isPublic = false;
        return view('dashboard.index', compact('user', 'isOwner', 'isPublic'));
    }

    public function public_index(Request $request)
    {
        $isPublic = true;
        $isOwner = ($user = User::find($request->user_id)) == auth()->user();
        return view('dashboard.index', compact('user', 'isOwner', 'isPublic'));
    }


    public function setting(Request $request)
    {
        $user = Auth::user();
        $corporation = $user;

        if ($user->user_type == "invidual") {
            return view('invidual.setting', compact('user'));
        }
        if ($user->user_type == "corporation") {
            return view('corporation.setting', compact('corporation'));
        }
    }



    public function inbox(Request $request)
    {
        $user = Auth::user();
        $requester_certs = SignCert::where('user_id', $user->id)->get();
        $reciver_certs = SignCert::where('reciver', $user->email)->get();
        $creator_certs = SignCert::where('corporation_id', $user->id)->get(); //todo remove it from invidual inbox
        return view('dashboard.inbox', compact('user', 'requester_certs', 'reciver_certs', 'creator_certs'));
    }
}
