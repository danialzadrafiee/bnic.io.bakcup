@php
    $me = auth()->user();
@endphp
<x-layout.dashboard :user="$me">
    <main class="container relative mx-auto flex flex-col py-6 px-4 space-y-6">
        <x-qrcode class="rounded w-36 h-36" data="http://localhost:8000/ballots/1"></x-qrcode>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-primary text-white px-6 py-4">
                <h1 class="text-3xl font-semibold">{{ $ballot->title }}</h1>
                <p>{{ $ballot->description }}</p>
            </div>
            <div class="grid grid-cols-2 gap-16 p-6">
                @php
                    $creator = $ballot
                        ->users()
                        ->where('role', 'creator')
                        ->first();
                @endphp
                <div class="space-y-2">
                    <p class="flex justify-between"><span>Created At:</span><span
                            class="font-medium capitalize">{{ $ballot->created_at->diffForHumans() }}</span></p>
                    <p class="flex justify-between items-center"><span>Last Vote:</span><span
                            class="font-medium capitalize">{!! $lastVoteDate ? $lastVoteDate->diffForHumans() : 'You are first' !!}</span></p>
                    <p class="flex justify-between"><span>Creator:</span><span
                            class="font-medium capitalize">{{ $creator->user_type == 'invidual' ? $creator->first_name . ' ' . $creator->last_name : $creator->corp_name }}</span>
                    </p>

                </div>
                <div class="space-y-2">
                    <p class="flex justify-between"><span>Min required votes:</span><span
                            class="font-medium capitalize">{{ $ballot->min_required_votes }}</span></p>
                    <p class="flex justify-between">
                        <span>End Date:</span>
                        <span
                            class="font-medium capitalize">{{ date('F j, Y, g:i A', strtotime($ballot->ending_date)) }}</span>
                    </p>
                    <p class="flex justify-between"><span>Percentage of Min Requirement:</span><span
                            class="font-medium capitalize">{{ $percentageOfMinRequirement }}%</span></p>
                </div>
            </div>
        </div>

        <div class="grid grid-flow-row grid-cols-2 gap-4 items-stretch">
            @foreach ($ballot->options as $option)
                <div class="bg-white rounded-lg shadow-md  flex flex-col justify-center p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">{{ $option->value }}</h3>
                        <div class="space-x-2">
                            @if ($me->votes->where('ballot_id', $ballot->id)->count() == 0)
                                <button type="button" class="voteBtn px-4 py-2 bg-primary text-white rounded-lg"
                                    data-option-id="{{ $option->id }}">Vote</button>
                            @else
                                @if ($me->votes->where('ballot_id', $ballot->id)->first()->option_id == $option->id)
                                    <badge class="badge badge-secondary">Your vote</badge>
                                @endif
                            @endif

                            <div class="js_vote_counter inline-block" id="votesForOption{{ $option->id }}">Loading
                                votes...</div>
                        </div>
                    </div>
                    <div class="bg-gray-200 rounded-lg">
                        <div class="bg-primary text-white py-1 px-2 rounded-lg"
                            style="width: {{ $percentageOfVotes[$option->id] }}%;">
                            {{ $percentageOfVotes[$option->id] }}%
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if (!$ballot->anonymous)
            <div class="splace-y-6">
                <div class="bg-white rounded-lg shadow-md p-6 space-y-4">
                    <div class="flex flex-col gap-2">
                        <p class="font-medium capitalize">Users who voted :</p>
                        <div class="grid grid-cols-5 grid-flow-row capitalize gap-2 ">
                            @foreach ($usersWhoVoted as $voter)
                                <a href="{{ route('dashboard.public_index', $voter->id) }}"
                                    class="btn !capitalize btn-ghost grow  border border-neutral-5/30 flex items-center gap-2 ">
                                    <img class="rounded-full w-6 h-6" src="{{ $voter->profile_picture }}">
                                    {{ $voter->user_type == 'invidual' ? $voter->first_name . ' ' . $voter->last_name : $voter->corp_name }}
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(function() {
            var ballotId = {{ $ballot->id }};

            $('.voteBtn').click(function() {
                var optionId = $(this).data('option-id');

                axios.post('/votes', {
                    ballot_id: ballotId,
                    option_id: optionId
                }).then(function(response) {
                    loadVotesForOption(optionId);
                    window.location.reload();
                }).catch(function(error) {
                    console.log(error);
                });
            });

            const loadVotesForOption = async (optionId) => {
                try {
                    const {
                        data: votes
                    } = await axios.get(`/ballots/${ballotId}/votes`);

                    if (votes.length) {
                        const optionVotes = votes.filter(({
                            option_id
                        }) => option_id == optionId);
                        if (optionVotes.length) {
                            optionVotes.forEach(({
                                total: votesForOption
                            }) => $(`#votesForOption${optionId}`).text(`Votes: ${votesForOption}`));
                        } else {
                            $(`#votesForOption${optionId}`).text('Votes: 0');
                        }
                    } else {
                        $('.js_vote_counter').html('Votes: 0');
                    }
                } catch (error) {
                    document.querySelector('.js-g-alert').style.display = 'grid';
                    console.log(error);
                    document.querySelector('.js_error').textContent = error.response.data.error;
                }
            };


            @foreach ($ballot->options as $option)
                loadVotesForOption({{ $option->id }});
            @endforeach
        });
    </script>
</x-layout.dashboard>
