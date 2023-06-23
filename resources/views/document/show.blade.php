<x-layout.global>
    @vite(['resources/css/corporation-show.scss', 'resources/js/document-show.js'])
    <input type="hidden" class="js-is-owner"
        value="{{ auth()->user()->id == $document->corporation->id ? 'true' : 'false' }}">
    <main class="flex">
        <x-aside></x-aside>
        <core>
            <navigation>
                <widgect class="__widgect-info">
                    <heading>Document Explorer</heading>
                    <inside>
                        <qrcode>
                            <img src="{{ asset('img/placeholder/qrcode.png') }}" alt="">
                        </qrcode>
                        <name>{{ $document->name }}</name>
                        <wallet>0x29d7d1dd5b6f9c864d9db560d72a247c178ae86b</wallet>
                    </inside>
                </widgect>
                <widgect class="__widgect-info">
                    <heading>Corporation</heading>
                    <content class="items-start flex flex-col gap-2 p-4">
                        <corpname>
                            <label class="text-neutral">Name: </label>
                            <value>
                                {{ $document->corporation->corp_name }}
                            </value>
                        </corpname>
                        <idcode>
                            <label class="text-neutral">Code: </label>
                            <value>
                                {{ $document->corporation->corp_type[0] }}-{{ substr(hash('sha256', $document->corporation->email), 0, 8) }}-{{ $document->corporation->id }}
                            </value>
                        </idcode>
                        <show>
                            <label class="text-neutral">link: </label>

                            <a href="{{ route('dashboard.index', ['id' => $document->corporation->id]) }}"
                                class="text-primary text-sm">Show
                                Corporation</a>
                        </show>
                    </content>
                </widgect>
            </navigation>

            <article>
                <style>
                    form input,
                    form textarea {
                        border: 1px solid rgb(233, 233, 233);
                    }
                </style>
                <section class="bg-white py-20">
                    <form method="POST" class="js-form-data bg-white w-[750px] mx-auto">
                        {!! $document->content !!}
                    </form>
                    @if (auth()->user()->id != $document->corporation->id)
                        <form action="{{ route('cert.sign') }}" method="POST" class="js-form-real">
                            <input type="hidden" name="reciver" value="{{ $document->reciver }}">
                            <input type="hidden" name="document_id" value="{{ $document->id }}">
                            <input type="hidden" name="corporation_id" value="{{ $document->corporation->id }}">
                            <input type="hidden" name="data" class="js-hidden-real-content">
                            <input type="hidden" name="name" value="{{ $document->name }}">
                            <input type="hidden" name="image" value="{{ $document->image }}">
                            <input type="hidden" name="description" value="{{ $document->description }}">
                            @csrf
                            <additional class="">
                                <label>Additional informations </label>
                                <row class="js-row-additional">
                                    <input name="ad_email[]" placeholder="Email" readonly class="js-input-email">
                                    <input name="ad_role[]" placeholder="Role">
                                    <input name="ad_describe[]" placeholder="Describe">
                                    <button type="button" class="js-add-additional-row"> + </button>
                                    <button type="button" class="js-rem-additional-row" style="display: none"> -
                                    </button>
                                </row>
                            </additional>
                            @if (auth()->user()->id != $document->corporation->id)
                                <button type="button" class="js-btn-sign">
                                    Sign Document
                                </button>
                            @else
                                <button type="button"
                                    class=" bg-neutral rounded text-white px-4 py-2 block w-max ml-auto">
                                    You are owner of this document
                                </button>
                            @endif
                        </form>
                    @endif

                </section>
            </article>
        </core>

        <modal
            class="js-modal-select-user w-screen h-screen bg-black/80 fixed inset-0 m-auto z-10 flex flex-col items-center justify-center"
            style="display:none">
            <inside class="w-[950px]  rounded flex-col flex bg-white">
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
</x-layout.global>
