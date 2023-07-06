@php
    $corp = App\Models\User::find($document->corporation_id);
@endphp
<x-layout.dashboard :user="$corp">
    <style>
        .set-publicity {
            display: none;
        }

        .css_hide_it_in_show {
            display: none;
        }
    </style>
  @vite('resources/css/filepond.scss')
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
    " rel="stylesheet">

    <input type="hidden" class="js-is-owner"
        value="{{ auth()->user()->id == $document->corporation_id ? 'true' : 'false' }}">
    <main class="flex">
        <core class="w-full">


            <article class="w-full">
                <style>
                    form input,
                    form textarea {
                        border: 1px solid rgb(233, 233, 233);
                    }

                    .css_delete {
                        display: none !important;
                    }
                </style>
                <section class="bg-white rounded-xl shadow-lg mt-8 py-20">


                    <form method="POST" class="js-form-data bg-white mx-auto p-12">
                        {!! $document->content !!}
                    </form>
                    <form action="{{ route('cert.sign') }}" method="POST" class="js-form-real">
                        @if (auth()->user()->id != $document->corporation->id)
                            <input type="hidden" name="reciver" value="{{ $document->reciver }}">
                            <input type="hidden" name="document_id" value="{{ $document->id }}">
                            <input type="hidden" name="corporation_id" value="{{ $document->corporation->id }}">
                            <input type="hidden" name="data" class="js-hidden-real-content">
                            <input type="hidden" name="name" value="{{ $document->name }}">
                            <input type="hidden" name="image" value="{{ $document->image }}">
                            <input type="hidden" name="description" value="{{ $document->description }}">
                            @csrf
                            <additional class="px-20 w-full block">
                                <label>Additional people </label>
                                <row class="js-row-additional grid grid-flow-col gap-2 py-2 justify-stretch w-full ">
                                    <input name="ad_email[]" placeholder="Email" readonly
                                        class="js-input-email input border-neutral-5/30">
                                    <input name="ad_role[]" placeholder="Role" class="input border-neutral-5/30">
                                    <input name="ad_describe[]" placeholder="Describe"
                                        class="input border-neutral-5/30">
                                    <button type="button" class="js-add-additional-row btn btn-neutral"> + </button>
                                    <button type="button" class="js-rem-additional-row btn btn-error"
                                        style="display: none"> -
                                    </button>
                                </row>
                            </additional>
                        @endif
                        @if (auth()->user()->id != $document->corporation->id)
                            <button type="button" class="js-btn-sign btn btn-primary mx-20 my-8">
                                Sign Document
                            </button>
                        @else
                            <button type="button" class=" bg-neutral mx-20 rounded text-white px-4 py-2 block w-max">
                                You are creator of this document
                            </button>
                        @endif
                    </form>
                </section>
            </article>
        </core>

        <modal
            class="js-modal-select-user w-screen h-screen bg-black/80 fixed inset-0 m-auto z-10 flex flex-col items-center justify-center"
            style="display:none">
            <inside class="w-full  rounded flex-col flex bg-white">
                <header class="flex items-center p-4 justify-between">
                    <heading class="text-lg">Search and select user</heading>
                    <searchbox class="flex">
                        <input type="text"
                            class="js-input-search bg-neutral/5 rounded rounded-r-none border border-neutral/20 px-4 py-2"
                            placeholder="Search user">
                        <button
                            class="js-btn-search bg-primary/80 hover:bg-primary rounded-r text-white text-sm text-center p-2">Search</button>
                    </searchbox>
                </header>


                <section class="js-section-search-result p-4 overflow-y-auto h-[500px]">
                    @foreach ($modal_users as $user)
                        <user class="js-row-user rounded border-b py-4  border-neutral/20 flex gap-4 flex-row w-full  ">
                            <column class="flex shrink-0 w-[84px] h-[84px]">
                                <img src="https://api.dicebear.com/6.x/identicon/svg?seed={{ $user->email }}"
                                    class="js-search-user-image w-[84px] h-[84px] block rounded bg-neutral/10 p-2">
                            </column>
                            <column class="flex flex-col  self-end gap-0">
                                <name>
                                    <span class="js-search-user-first-name"> {{ $user->first_name }} </span>
                                    <span class="js-search-user-last-name"> {{ $user->last_name }} </span>
                                </name>
                                <wallet class="js-search-user-wallet text-neutral text-sm">{{ $user->wallet }}</wallet>
                                <email class="js-search-user-email text-neutral text-sm">{{ $user->email }}</email>
                                <code class="text-neutral text-sm js-search-user-code">
                                    {{ $user->gender[0] }}-{{ substr(hash('sha256', $user->email), 0, 8) }}-{{ $user->id }}</code>
                            </column>
                            <column class="flex flex-col  self-center">
                                <about class="js-search-user-cv text-sm text-neutral">
                                    {!! strlen(strip_tags($user->cv)) > 90 ? substr(strip_tags($user->cv), 0, 90) . '..' : strip_tags($user->cv) !!}
                                </about>
                            </column>
                            <column class="self-start">
                                <button
                                    class="js-btn-select-user bg-primary/80 hover:bg-primary rounded text-white text-center text-xs p-2"
                                    data-email="{{ $user->email }}">Select</button>
                            </column>
                        </user>
                    @endforeach
                </section>
            </inside>
        </modal>
    </main>

    @vite(['resources/js/document-show.js'])

</x-layout.dashboard>
