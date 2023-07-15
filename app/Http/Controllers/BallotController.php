<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ballot;
use App\Models\BallotUser;
use App\Models\Option;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BallotController extends Controller
{
    // Show list of all ballots
    public function index()
    {
        $userId = auth()->id();

        $ballots = Ballot::where(function ($query) use ($userId) {
            $query->where('type', 'public')
                ->orWhereHas('users', function ($query) use ($userId) {
                    $query->where('user_id', $userId)
                        ->where('candidate', true);
                });
        })->get();

        return view('ballots.index', compact('ballots'));
    }
    // Show a single ballot
    public function show(Ballot $ballot)
    {
        // Retrieve last vote date
        $lastVoteDate = $ballot->votes()->latest()->first()->created_at ?? null;

        // Retrieve users who voted
        $usersWhoVoted = $ballot->anonymous ? [] : $ballot->votes()->with('user')->get()->pluck('user');

        // Calculate percentage of minimum requirement
        $totalVotes = $ballot->votes()->count();
        $percentageOfMinRequirement = ($totalVotes / $ballot->min_required_votes) * 100;

        // Calculate percentage of votes for each option
        $votesForEachOption = $ballot->options()->withCount('votes')->get()->pluck('votes_count', 'id')->toArray();
        $totalOptionVotes = array_sum($votesForEachOption);
        $percentageOfVotes = [];
        foreach ($votesForEachOption as $optionId => $votes) {
            $percentageOfVotes[$optionId] = ($votes / 1) * 100;
        }

        return view('ballots.show', compact('ballot', 'lastVoteDate', 'usersWhoVoted', 'percentageOfMinRequirement', 'percentageOfVotes'));
    }

    // Show the form for creating a new ballot
    public function create()
    {
        return view('ballots.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required|in:private,public',
            'anonymous' => 'nullable',
            'min_required_votes' => 'integer',
            'ending_date' => 'required|date',
            'candidates' => 'required_if:type,private|array',
            'candidates.*' => 'exists:users,id',
            'options' => 'required|array',
            'options.*' => 'required|string'
        ]);

        // Create a new ballot
        $ballot = new Ballot([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'anonymous' => $request->anonymous ? true : false,
            'min_required_votes' => $request->min_required_votes,
            'ending_date' => $request->ending_date,
        ]);
        // $maxToken = DB::table('ballots')->max('token');
        // $ballot->token = $maxToken ? $maxToken + 1 : 400100;
        $ballot->save();
        // Create a new BallotUser with role as 'creator'
        $ballotUser = new BallotUser([
            'user_id' => auth()->id(),
            'ballot_id' => $ballot->id,
            'role' => 'creator',
            'candidate' => true
        ]);
        // Save the BallotUser
        $ballotUser->save();




        $fullname = auth()->user()->user_type == 'invidual' ? auth()->user()->first_name . ' ' . auth()->user()->last_name : auth()->user()->corp_name;
        $controller = app()->make(MailController::class);

        // If the ballot type is private, add each candidate to the BallotUser table
        if ($request->type === 'private') {
            foreach ($request->candidates as $candidateId) {
                $candidate = new BallotUser([
                    'user_id' => $candidateId,
                    'ballot_id' => $ballot->id,
                    'role' => 'voter',
                    'candidate' => true
                ]);

                $guest = User::where('id', $candidateId)->first();
                $data = [
                    "type" => 'voting_created',
                    'url' => route('ballots.show',  $ballot),
                    "sender_full_name" => $fullname,
                    'reciver_email' => $guest->email
                ];
                $controller->send_other_mails($data);
                $candidate->save();
            }
        }

        // Save the options for the ballot
        foreach ($request->options as $optionValue) {
            $option = new Option([
                'ballot_id' => $ballot->id,
                'value' => $optionValue
            ]);

            $option->save();
        }

        // Redirect to the new ballot
        return redirect()->route('ballots.show', $ballot);
    }


    // Delete a ballot
    public function destroy(Ballot $ballot)
    {
        // Check if the authenticated user is the creator of the ballot
        $creator = BallotUser::where([
            ['user_id', '=', auth()->id()],
            ['ballot_id', '=', $ballot->id],
            ['role', '=', 'creator']
        ])->first();

        // If the user is not the creator, abort with a 403 error
        if ($creator === null) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the ballot
        $ballot->delete();

        // Redirect to the ballots index
        return redirect()->route('ballots.index');
    }


    public function getVotes(Ballot $ballot)
    {
        $votes = $ballot->votes()->select('option_id', DB::raw('count(*) as total'))->groupBy('option_id')->get();

        return response()->json($votes);
    }
}
