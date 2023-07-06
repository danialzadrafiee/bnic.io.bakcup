@php
    $me = auth()->user();
    $users = \App\Models\User::take(10)
        ->where('user_type', 'invidual')
        ->get();
@endphp


<x-layout.dashboard :user="$me">



    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-file-poster@2.5.1/dist/filepond-plugin-file-poster.min.css"
        rel="stylesheet" />


    @vite(['resources/js/app.js', 'resources/js/event-create.js'])

    <main>
        <input type="hidden" class="js-creator-id" value="{{ $me->id }}">
        <content action="" class="bg-white h-max card p-8 max-w-full w-full @container/map">
            <grid class="grid grid-cols-8 gap-8 items-start">
                <grid class="js-main-col col-span-8 grid grid-cols-1  w-full gap-2">
                    <row class="grid grid-cols-2 items-center">
                        <column class="col-span-1">
                            <heading class="text-lg font-semibold">Create new event</heading>
                        </column>

                        <column class="col-span-1 justify-self-end">
                            <div class="form-control">
                                <div class="label flex gap-4 cursor-pointer">
                                    <label class="flex items-center gap-1 cursor-pointer">
                                        <span class="text-xs">Privite</span>
                                        <input type="radio" value="privite" name="event_publicity"
                                            class="radio radio-xs js_event_publicity">
                                    </label>
                                    <label class="flex items-center gap-1 cursor-pointer">
                                        <span class="text-xs">Public</span>
                                        <input type="radio" value="public" checked name="event_publicity"
                                            class="radio radio-xs js_event_publicity">
                                    </label>

                                </div>
                            </div>
                        </column>
                    </row>
                    <row class="grid gird-cols-1">
                        <field_title>
                            <input type="text" placeholder="Title *" name="title"
                                class="js-event-title input  border border-neutral-5/30  w-full" />
                        </field_title>
                    </row>
                    <row class="block h-max py-4">
                        <column>
                            <label class="block mb-2 text-neutral-700">Featured picture <sup
                                    class="text-error">*</sup></label>
                            <input type="file" class="filepond" value="0">
                            <input type="hidden" name="image" class="js-event-image" value="">
                        </column>
                    </row>
                    <label class="block  text-neutral-700">Event details <sup class="text-error">*</sup></label>
                    <textarea id="editor" name="description"
                        class="js-event-description block border rounded-lg min-h-[200px]  border-neutral-300 p-2"></textarea>
                        {{-- mapbox --}}
                    <row>
                        <label class="block  text-neutral-700 mb-2 mt-6">Select Location <sup
                                class="text-error">*</sup></label>
                        @include('event/mapbox')
                        <input type="text" class="border input js_map_lng">
                    </row>
                    <label class="text-sm mt-4">Accurate address information.</label>
                    <textarea class="js-accurate-location w-full textarea !border !border-neutral-5/30" name="accurate_location"
                        placeholder="123 Main Street, Apt, Cityville, Stateprovince 37663"></textarea>
                    <footer class="flex justify-between">

                        <div class="col-span-6 sm:col-span-3">
                            <input type="datetime-local" name="end_at" id="end_at" autocomplete="end-date"
                                class="js-end-date mt-1 block w-full py-2 px-3 border rounded-bl-none border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <label for="end_at"
                                class="block px-3 text-xs w-max py-2 rounded-t-none border border-t-0 rounded-lg border-neutral-5/30 font-medium text-gray-700">Ending
                                date</label>
                        </div>
                        <button class="js-create-invite ml-auto flex btn btn-primary">Create invitation</button>
                    </footer>
                </grid>
                <users class="col-span-2  js-invite-list-section grid grid-cols-1 gap-2 grow h-max" style="display: none">
                    <row class="grid grid-cols-1 w-full">
                        <column class="col-span-1 items-center">
                            <heading class="text-lg font-semibold">Invite list</heading>
                            <row class="grid py-3 grid-flow-row gap-4 js-selected-users">
                                <button
                                    class="btn btn-sm btn-neutral border bg-transparent text-neutral-300 cursor-pointer border-neutral-300 h-max rounded-lg p-3.5 flex items-center justify-center js_show_user_select_modal">
                                    <x-fas-plus></x-fas-plus>
                                </button>
                            </row>

                        </column>

                    </row>

                </users>
            </grid>


        </content>
    </main>




    {{-- modals --}}

    <modal>
        <dialog id="user_select" class="modal">
            <form method="dialog" class="modal-box min-w-[400px]">
                <header class="flex justify-between items-center">
                    <heading class="font-bold text-lg">Select user</heading>
                    <search class="join">
                        <div>
                            <div>
                                <input class="js-search-input input input-sm  input-bordered join-item"
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
                                <img src="https://api.dicebear.com/6.x/shapes/svg?seed={{ $user->email }}"
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
    <!-- Quill -->

    <style>
        .filepond--credits {
            display: none;
        }
    </style>



</x-layout.dashboard>
