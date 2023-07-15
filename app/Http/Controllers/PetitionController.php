<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petition;
use App\Models\User;
use DB;

class PetitionController extends Controller
{
    public function index()
    {
        $petitions = Petition::all();
        return view('petitions.index', compact('petitions'));
    }

    public function show(Petition $petition)
    {
        return view('petitions.show', compact('petition'));
    }

    public function create()
    {
        return view('petitions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'hashtag' => 'required|unique:petitions',
            'content' => 'required',
            'end_at' => 'required|date|after:today',
            'type' => 'required',
            'min' => 'required'
        ]);

        $auth_user = User::find(auth()->user()->id);
        $input = $request->except('_token');
        $petition = $auth_user->petitions()->create($input);
        $petition->users()->updateExistingPivot(auth()->user()->id, ['user_role' => 'creator']);

        $maxToken = DB::table('petitions')->max('token');
        $petition->token = $maxToken ? $maxToken + 1 : 600100;
        $petition->save();


        return redirect()->route('petitions.index');
    }


    public function sign(Petition $petition)
    {
        if ($petition->users()->where('user_id', auth()->user()->id)->whereNot('user_role', 'creator')->exists()) {
            return back()->withErrors(['error' => 'You have already signed this petition']);
        }

        if (now() > $petition->end_at) {
            return back()->withErrors(['error' => 'This petition has ended']);
        }

        $petition->users()->attach(auth()->user()->id, ['user_role' => 'signer']);

        return back();
    }

    public function destroy(Petition $petition)
    {
        if ($petition->users()->wherePivot('user_role', 'signer')->count() >= 10) {
            return back()->withErrors(['error' => 'You cannot delete a petition with 10 or more signatures.']);
        }

        $petition->delete();

        return back();
    }
}
