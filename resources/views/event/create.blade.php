@php
    $me = auth()->user();
    $users = \App\Models\User::take(10)
        ->where('user_type', 'invidual')
        ->get();
@endphp
<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/@pqina/pintura@8.60.2/pintura.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-file-poster@2.5.1/dist/filepond-plugin-file-poster.min.css" rel="stylesheet" />

@vite(['resources/js/app.js', 'resources/js/event-create.js'])
<x-layout.dashboard :user="$me">
    <main>

        <input type="hidden" class="js-creator-id" value="{{ $me->id }}">
        <content action="" class="bg-white h-max card p-8 max-w-full w-full">
            <grid class="grid grid-cols-8 gap-8 items-start">
                <grid class="js-main-col col-span-6 grid grid-cols-1  w-full gap-2">
                    <row class="grid grid-cols-2 items-center">
                        <column class="col-span-1">
                            <heading class="text-lg font-semibold">Create new event</heading>
                        </column>

                        <column class="col-span-1 justify-self-end">
                            <div class="form-control">
                                <label class="label flex gap-4 cursor-pointer">
                                    <span class="label-text">Privite</span>
                                    <input type="checkbox" class="js-publicity-toggle toggle" checked />
                                </label>
                            </div>
                        </column>
                    </row>
                    <row class="grid gird-cols-1">
                        <field_title>
                            <input type="text" placeholder="Title"
                                class="js-event-title input input-bordered w-full" />
                        </field_title>
                    </row>
                    <row class="block h-max py-4">
                        <column>
                            <label class="block mb-2 text-neutral-700">Featured picture</label>
                            <input type="file" class="filepond" value="0">
                            <input type="hidden" name="image" class="js-event-image" value="">
                        </column>
                    </row>
                    <label class="block  text-neutral-700">Event details</label>
                    <row class="block border rounded-lg min-h-[200px]  border-neutral-300 ">
                        <editor id="editor" class="">
                        </editor>
                    </row>
                    <footer>
                        <button class="js-create-invite ml-auto flex btn btn-primary">Create invitation</button>
                    </footer>
                </grid>
                <users class="col-span-2 js-invite-list-section grid grid-cols-1 gap-2 grow h-max">
                    <row class="grid grid-cols-1 w-full">
                        <column class="col-span-1 items-center">
                            <heading class="text-lg font-semibold">Invite list</heading>
                        </column>
                    </row>
                    <row class="grid py-3 grid-cols-1 gap-2 js-selected-users">
                        <button
                            class="btn btn-sm btn-neutral border bg-transparent text-neutral-300 cursor-pointer border-neutral-300 h-max rounded-lg p-3.5 flex items-center justify-center"
                            onclick="user_select.showModal()">
                            <x-fas-plus></x-fas-plus>
                        </button>
                    </row>
                </users>
            </grid>
        </content>
        {{-- modals --}}




    </main>









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
</x-layout.dashboard>
<style>
    .filepond--credits{
        display: none;
    }
</style>