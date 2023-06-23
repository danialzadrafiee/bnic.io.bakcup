<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;

class OptionController extends Controller
{
    // Store a new option
    public function store(Request $request)
    {
        $request->validate([
            'ballot_id' => 'required|exists:ballots,id',
            'value' => 'required',
        ]);

        $option = new Option($request->all());
        $option->save();

        return redirect()->back();
    }

    // Update an existing option
    public function update(Request $request, Option $option)
    {
        $request->validate([
            'value' => 'required',
        ]);

        $option->update($request->all());

        return redirect()->back();
    }

    // Delete an option
    public function destroy(Option $option)
    {
        $option->delete();

        return redirect()->back();
    }
}
