<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Ballot;
use App\Models\BallotUser;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ballot_id' => 'required|exists:ballots,id',
            'option_id' => 'required|exists:options,id',
        ]);

        // Make sure the user is allowed to vote in this ballot
        $ballot = Ballot::findOrFail($request->ballot_id);
        $ballotUser = BallotUser::where('ballot_id', $ballot->id)
            ->where('user_id', auth()->id())
            ->first();

        // For private ballots, the user must be a candidate
        if ($ballot->type === 'private' && (!$ballotUser->candidate && $ballotUser->role != 'creator')) {
            
            return response()->json(['error' => 'Not authorized to vote in this ballot'], 403);
        }

        // // For public ballots, the user must be a voter or a creator
        // if ($ballot->type === 'public' && $ballotUser->role !== 'voter' && $ballotUser->role !== 'creator') {
        //     return response()->json(['error' => 'Not authorized to vote in this ballot'], 403);
        // }

        // Ensure the user hasn't voted in this ballot already
        $existingVote = Vote::where('ballot_id', $ballot->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($existingVote) {
            return response()->json(['error' => 'You have already voted in this ballot'], 409);
        }

        // Create and save the vote
        $vote = new Vote([
            'ballot_id' => $request->ballot_id,
            'option_id' => $request->option_id,
            'user_id' => auth()->id(),
        ]);

        $vote->save();

        return response()->json(['success' => 'Vote cast successfully']);
    }
}
