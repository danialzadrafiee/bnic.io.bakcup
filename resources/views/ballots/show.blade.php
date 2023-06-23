@php
    $me = auth()->user();
@endphp
<x-layout.dashboard :user="$me">
    <main class="container mx-auto py-6 px-4 space-y-6 bg-gray-100">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-indigo-500 text-white px-6 py-4">
                <h1 class="text-3xl font-bold">{{ $ballot->title }}</h1>
                <p>{{ $ballot->description }}</p>
            </div>
            <div class="grid grid-cols-2 gap-4 p-6">
                @php
                    $creator = $ballot
                        ->users()
                        ->where('role', 'creator')
                        ->first();
                @endphp
                <div class="space-y-2">
                    <p class="flex justify-between"><span>Created At:</span><span class="font-medium">{{ $ballot->created_at }}</span></p>
                    <p class="flex justify-between"><span>Last Vote:</span><span class="font-medium">{{ $lastVoteDate }}</span></p>
                    <p class="flex justify-between"><span>Creator:</span><span class="font-medium">{{ $creator->user_type == 'individual' ? $creator->first_name . ' ' . $creator->last_name : $creator->corp_name }}</span></p>
                    @if (!$ballot->anonymous)
                        <div>
                            <p>Users who voted:</p>
                            <ul class="list-disc list-inside text-gray-700">
                                @foreach ($usersWhoVoted as $voter)
                                    <li>{{ $voter->user_type == 'individual' ? $voter->first_name . ' ' . $voter->last_name : $voter->corp_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="space-y-2">
                    <p class="flex justify-between"><span>Min required votes:</span><span class="font-medium">{{ $ballot->min_required_votes }}</span></p>
                    <p class="flex justify-between"><span>End Date:</span><span class="font-medium">{{ $ballot->ending_date }}</span></p>
                    <p class="flex justify-between"><span>Percentage of Min Requirement:</span><span class="font-medium">{{ $percentageOfMinRequirement }}%</span></p>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            @foreach ($ballot->options as $option)
                <div class="bg-white rounded-xl shadow-md p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold">{{ $option->value }}</h3>
                        <div class="space-x-2">
                            <button type="button" class="voteBtn px-4 py-2 bg-indigo-500 text-white rounded-lg" data-option-id="{{ $option->id }}">Vote</button>
                            <div class="js_vote_counter inline-block" id="votesForOption{{ $option->id }}">Loading votes...</div>
                        </div>
                    </div>
                    <div class="bg-gray-200 rounded-lg">
                        <div class="bg-indigo-500 text-white py-1 px-2 rounded-lg" style="width: {{ $percentageOfVotes[$option->id] }}%;">
                            {{ $percentageOfVotes[$option->id] }}%
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
                    alert('You voted for option ' + optionId);
                    loadVotesForOption(optionId);
                }).catch(function(error) {
                    document.querySelector('.js-g-alert').style.display = 'grid';
                    document.querySelector('.js_error').textContent = error.response.data.error;
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
