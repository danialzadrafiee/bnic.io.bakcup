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

                    <flex id="optionInput0" class="mb-2 flex gap-2 items-center w-full">
                        <input type="text" name="options[]" class="optionInput input input-bordered w-full" placeholder="Enter an option">
                        <button type="button" id="addOptionBtn" class="btn btn-neutral w-[140px]">Add Option</button>
                    </flex>
                </div>



                <!-- Candidates -->
                {{-- <div class="form-control flex flex-col space-y-1">
                    <label for="candidates" class="block text-sm text-gray-600">Candidates</label>
                    <select id="candidates" multiple class="py-3 select select-bordered w-full">

                        <!-- Your options here -->
                    </select>
                    <input type="text" id="candidateSearch" placeholder="Search for users..." class="input input-bordered">
                </div>
                <div id="candidatesDiv" class="grid grid-cols-2 w-full gap-4">
                </div> --}}
                <input id="autocomplete-input" type="text">
                <div id="candidatesDiv"></div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var optionInputIndex = 1;

        $('#addOptionBtn').click(function() {
            optionInputIndex++;
            $('#optionInputsContainer').append(
                $('<div>').attr({
                    id: `optionInput${optionInputIndex}`,
                    class: 'mb-2 flex gap-2 items-center w-full'
                }).append(
                    $('<input>').attr({
                        type: 'text',
                        name: 'options[]',
                        class: 'optionInput input input-bordered w-full'
                    }),
                    $('<button>').attr({
                        type: 'button',
                        class: 'removeOptionBtn btn btn-error w-[140px]'
                    }).text('Remove')
                )
            );
        });
        $(document).on('click', '.removeOptionBtn', function() {
            $(this).parent().remove();
        });



    </script>

</x-layout.dashboard>
