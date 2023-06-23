@php
    $me = auth()->user();
@endphp
<x-layout.dashboard :user="$me">

    <main>
        <div class="container mx-auto px-8 py-12 bg-white rounded-xl">
            <h1 class="text-2xl font-semibold mb-6">Create New Ballot</h1>
            <p class="text-gray-600 mb-8">Create a new voting box by filling out the form below. Please make sure all the details are correct before submitting.</p>

            <form action="{{ route('ballots.store') }}" method="POST" id="ballotForm" class="flex flex-col space-y-6">
                @csrf

                <!-- Title -->
                <div class="form-control flex flex-col space-y-1">
                    <label for="title" class="text-sm text-gray-600">Title</label>
                    <input type="text" name="title" id="title" class="input input-bordered" placeholder="Enter the title of the voting box">
                </div>

                <!-- Description -->
                <div class="form-control flex flex-col space-y-1">
                    <label for="description" class="text-sm text-gray-600">Description</label>
                    <textarea name="description" id="description" class="textarea textarea-bordered" rows="4" placeholder="Describe the purpose of the voting box"></textarea>
                </div>

                <!-- Type -->
                <div class="form-control flex flex-col space-y-1">
                    <label for="type" class="text-sm text-gray-600">Type</label>
                    <select name="type" id="type" class="select select-bordered">
                        <option value="public">Public - Visible to everyone</option>
                        <option value="private">Private - Only visible to specified voters</option>
                    </select>
                </div>

                <!-- Ending date -->
                <div class="form-control flex flex-col space-y-1">
                    <label for="ending_date" class="text-sm text-gray-600">Ending Date</label>
                    <input type="datetime-local" name="ending_date" id="ending_date" class="input input-bordered">
                </div>

                <!-- Options -->
                <div id="optionInputsContainer" class="flex flex-col space-y-4">
                    <label for="options" class="block text-sm text-gray-600">Options</label>

                    <div id="optionInput0" class="mb-2">
                        <input type="text" name="options[]" class="optionInput input input-bordered w-full" placeholder="Enter an option">
                        <button type="button" class="removeOptionBtn hidden">Remove</button>
                    </div>
                </div>

                <button type="button" id="addOptionBtn" class="btn btn-neutral">Add Option</button>

                <!-- Candidates -->
                <div class="form-control flex flex-col space-y-1">
                    <label for="candidates" class="block text-sm text-gray-600">Candidates</label>
                    <select name="candidates[]" id="candidates" multiple class="select select-bordered w-full">
                        <!-- Candidates will be dynamically populated -->
                    </select>
                    <input type="text" id="candidateSearch" placeholder="Search for users..." class="input input-bordered">
                </div>

                <!-- Minimum require votes -->
                <div class="form-control flex flex-col space-y-1">
                    <label for="min_required_votes" class="block text-sm text-gray-600">Minimum Required Votes</label>
                    <input type="number" name="min_required_votes" value="2" min="2" max="1000000" class="input input-bordered">
                </div>

                <!-- Anonymous -->
                <div class="form-control flex items-center justify-between">
                    <label for="anonymous" class="block text-sm text-gray-600">Anonymous Voting</label>
                    <input type="checkbox" name="anonymous" value="false" class="toggle toggle-primary" onclick="(this.value == 'on' ? this.value = true : this.value = false)">
                </div>

                <button type="submit" class="createBtn btn btn-primary w-full">Create Ballot</button>
            </form>
        </div>
    </main>
    <!-- Scripts are moved to the bottom -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(function() {
            var optionInputIndex = 1;

            $('#addOptionBtn').click(function() {
                $('#optionInputsContainer').append(`
            <div id="optionInput${optionInputIndex}" class="mb-2">
                <input type="text" name="options[]" class="optionInput input input-bordered w-full">
                <button type="button" class="removeOptionBtn">Remove</button>
            </div>
        `);

                optionInputIndex++;
            });

            $(document).on('click', '.removeOptionBtn', function() {
                $(this).parent().remove();
            });

            $('#candidateSearch').on('keyup', function() {
                var term = $(this).val();

                axios.get(route('walletconnect.search_invidual'), {
                    params: {
                        term: term
                    }
                }).then(function(response) {
                    var users = response.data;
                    var options = '';

                    for (var i = 0; i < users.length; i++) {
                        options += `<option value="${users[i].id}">${users[i].first_name}</option>`;
                    }
                    $('#candidates').html(options);
                });
            });
        });
    </script>

</x-layout.dashboard>
