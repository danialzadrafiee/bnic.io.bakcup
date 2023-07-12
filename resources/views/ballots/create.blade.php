@php
    $me = auth()->user();
    $users = \App\Models\User::take(10)
        ->where('user_type', 'invidual')
        ->get();
@endphp
@vite('resources/js/ballot-create.js')
<x-layout.dashboard :user="$me">

    <main>
        <div class="container mx-auto px-8 py-12 bg-white rounded-xl">
            <h1 class="text-2xl font-semibold mb-6">Create New Ballot</h1>
            <p class="text-gray-600 mb-8">Create a new voting box by filling out the form below. Please make sure all the
                details are correct before submitting.</p>

            <form action="{{ route('ballots.store') }}" method="POST" id="ballotForm" class="flex flex-col space-y-6">
                @csrf

                <!-- Title -->
                <div class="form-control flex flex-col space-y-1">
                    <label for="title" class="text-sm text-gray-600">Title</label>
                    <input type="text" value="{{ old('title') }}" name="title" id="title"
                        class="input  border-neutral-5/30" placeholder="Enter the title of the voting box">
                </div>

                <!-- Description -->
                <div class="form-control flex flex-col space-y-1">
                    <label for="description" class="text-sm text-gray-600">Description</label>
                    <textarea value="" name="description" id="description" class="textarea border border-neutral-5/30" rows="4"
                        placeholder="Describe the purpose of the voting box">{{ old('description') }}</textarea>
                </div>

                <!-- Type -->
                <div class="form-control flex flex-col space-y-1">
                    <label for="type" class="text-sm text-gray-600">Type</label>
                    <select value="{{ old('type') }}" name="type" id="type"
                        class="js_ballot_type select border border-neutral-5/30">
                        <option value="public">Public - Visible to everyone</option>
                        <option value="private">Private - Only visible to specified voters</option>
                    </select>
                </div>
                <!-- Users -->

                <div class="js_privite_row flex gap-2" style="display: none">
                    <button type="button" class="!h-[44px] js_show_user_select_modal btn btn-sm btn-primary">add
                        user</button>
                    <div class="js-selected-users flex gap-2">
                    </div>
                </div>



                <!-- Options -->
                <div id="optionInputsContainer" class="flex flex-col space-y-4">
                    <label for="options" class="block text-sm text-gray-600">Options</label>

                    <flex id="optionInput0" class="mb-2 flex gap-2 items-center w-full">
                        <input type="text" name="options[]" class="optionInput input  border-neutral-5/30 w-full"
                            placeholder="Enter an option">
                        <button type="button" id="addOptionBtn" class="btn btn-neutral w-[140px]">Add Option</button>
                    </flex>
                </div>


                <grid class="grid grid-flow-row grid-cols-2 gap-8">

                    <!-- Minimum require votes -->
                    <div class="form-control flex flex-col space-y-1">
                        <label for="min_required_votes" class="block text-sm text-gray-600">Minimum Required
                            Votes</label>
                        <input type="number" value="{{ old('min_required_votes') ?? '2' }}" name="min_required_votes"
                            min="2" max="1000000" class="input  border-neutral-5/30">
                    </div>
                    <!-- Ending date -->
                    <div class="form-control flex flex-col space-y-1">
                        <label for="ending_date" class="text-sm text-gray-600">Ending Date</label>
                        <input type="datetime-local" value="{{ old('ending_date') }}" name="ending_date"
                            id="ending_date" class="input  border-neutral-5/30">
                    </div>
                </grid>

                <!-- Anonymous -->
                <div class=" flex items-center gap-2">
                    <label for="anonymous" class="block text-sm text-gray-600">Anonymous Voting</label>
                    <input type="checkbox" value="{{ old('anonymous') }}" name="anonymous" value="false"
                        class="toggle toggle-primary"
                        onclick="(this.value == 'on' ? this.value = true : this.value = false)">
                </div>
                <div class="js-ballot-user-inputs">

                </div>

                <button type="submit" class="createBtn js-btn-submit btn btn-primary w-full">Create Ballot</button>
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
                        class: 'optionInput input  border-neutral-5/30 w-full'
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
    <script>
        $('.js_ballot_type').on('change', function() {

            $(this).val() == 'public' ? $('.js_privite_row').hide() : $('.js_privite_row').show()
        })
    </script>


    {{-- modals --}}

    <modal>
        <dialog id="user_select" class="modal">
            <form method="dialog" class="modal-box min-w-[400px]">
                <header class="flex justify-between items-center">
                    <heading class="font-bold text-lg">Select user</heading>
                    <search class="join">
                        <div>
                            <div>
                                <input
                                    class="js-search-input input input-sm  input-bordered border-neutral-5/30 join-item"
                                    placeholder="Search..." />
                            </div>
                        </div>
                        <div class="indicator">
                            <button type="button"
                                class="js-search-btn btn btn-sm btn-neutral join-item">Search</button>
                        </div>
                    </search>
                </header>
                <list class="js-searched-users flex mt-4 flex-col gap-4">
                    @foreach ($users as $user)
                        <card class="card bg-base-100 shadow">
                            <div class="card-body py-6 flex gap-4 flex-row items-center">
                                <img src="https://api.dicebear.com/6.x/initials/svg?seed={{ $user->email }}"
                                    class="w-10 h-10 rounded">
                                <div class="flex flex-col ">
                                    <div class="font-semibold">
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </div>
                                    <p class="text-sm">{{ $user->email }}</p>
                                </div>
                                <button job="add" value="{{ $user->id }}" type="button"
                                    class="js-select-user !w-20 btn btn-sm btn-neutral ml-auto">Select</button>
                            </div>
                        </card>
                    @endforeach
                </list>
            </form>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </modal>

</x-layout.dashboard>
