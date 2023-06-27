<widgects user-type="corporation">
    <section>
        <label>Corporation information</label>
        <grid class="grid grid-cols-3">
            <widgect class="flex flex-row items-center gap-3 _fullname">
                <right class="order-2">
                    <header>
                        Name
                    </header>
                    <value>
                        <span>{{ $user->corp_name }}</span>
                    </value>
                </right>
                <left class="order-1">
                    <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                        <x-fas-building class="w-[30px] h-[30px] text-primary "></x-fas-building>
                    </icon>
                </left>
            </widgect>

            <widgect class="flex flex-row items-center gap-3 _nationality-primary">
                <right class="order-2">
                    <header>
                        NATIONALITY PRIMARY
                    </header>
                    <value>
                        {{ $user->{"corp_country_pri"} }}
                        {{ $user->{"corp_state_pri"} }}
                    </value>
                </right>
                <left class="order-1">
                    <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                        <x-fas-flag class="w-[30px] h-[30px] text-primary "></x-fas-flag>
                    </icon>
                </left>
            </widgect>

            @if ($user->{"corp_country_sec"})
                <widgect class="flex flex-row items-center gap-3 _nationality-secondary">
                    <right class="order-2">
                        <header>
                            NATIONALITY SECONDARY
                        </header>
                        <value> {{ $user->{"corp_country_sec"} }}
                            {{ $user->{"corp_state_sec"} }}</value>
                    </right>
                    <left class="order-1">
                        <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                            <x-fas-flag class="w-[30px] h-[30px] text-primary "></x-fas-flag>
                        </icon>
                    </left>
                </widgect>
            @endif

        </grid>
    </section>
    <section>
        <label>Corporation Category</label>
        <grid class="grid grid-cols-3">
            <widgect class="flex flex-row items-center gap-3 _category-pri">
                <right class="order-2">
                    <header>
                        PRIMARY CATEGORY
                    </header>
                    <value>
                        {{ $user->{"corp_cat_pri"} }}
                    </value>
                </right>
                <left class="order-1">
                    <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                        <x-fas-folder class="w-[30px] h-[30px] text-primary "></x-fas-folder>
                    </icon>
                </left>
            </widgect>
            <widgect class="flex flex-row items-center gap-3 _category-sec">
                <right class="order-2">
                    <header>
                        SECONDARY CATEGORY
                    </header>
                    <value>
                        {{ $user->{"corp_cat_sec"} }}
                    </value>
                </right>
                <left class="order-1">
                    <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                        <x-fas-folder class="w-[30px] h-[30px] text-primary "></x-fas-folder>
                    </icon>
                </left>
            </widgect>
            <widgect class="flex flex-row items-center gap-3 _form">
                <right class="order-2">
                    <header>
                        FORM
                    </header>
                    <value>
                        {{ $user->{"corp_form"} }}
                    </value>
                </right>
                <left class="order-1">
                    <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                        <x-fas-industry class="w-[30px] h-[30px] text-primary "></x-fas-industry>
                    </icon>
                </left>
            </widgect>
        </grid>
    </section>
    <section>
        @if ($user->corp_cv != '')
            <label>Introdoction details</label>
            <grid class="grid grid-cols-1">
                <widgect class="flex flex-row items-center gap-3 _code">
                    <right class="order-2">
                        <header>
                            Describe
                        </header>
                        <value>
                            {!! $user->corp_cv !!}
                        </value>
                    </right>
                    <left class="order-1">
                        <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                            <x-fas-home class="w-[30px] h-[30px] text-primary "></x-fas-home>
                        </icon>
                    </left>
                </widgect>
            </grid>
        @endif
    </section>
    <section>
        <label>Documents</label>
        <grid class="grid grid-cols-3">

            @if ($isOwner)
                <widgect>
                    <header>
                        Documention
                    </header>
                    <value>
                        <span class="text-sm">
                            You able to create new documents
                        </span>
                        <br>
                        <a class="btn btn-sm btn-primary mt-4" href="{{ route('document.create') }}" class="text-primary">Create
                            Documention</a>
                    </value>
                    </right>

                </widgect>
            @endif

            @if (count($user->documents) == 0)
                <widgect>
                    <header>
                        No document
                    </header>
                    <value>
                        <span class="text-sm">
                            This corporation has no document.
                        </span>
                    </value>
                    </right>

                </widgect>
            @endif

            @foreach ($user->documents as $document)
                <widgect>
                    <header>
                        {{ $document->name }}
                    </header>
                    <value>
                        <img src="{{ $document->image }}" class="rounded-lg">
                        <span class="text-sm">
                            {{ $document->description }}
                        </span>
                        <br>
                        <a href="{{ route('document.show', ['document' => $document->id]) }}" class="text-primary">View
                            Documention</a>
                    </value>
                    </right>
                </widgect>
            @endforeach
        </grid>
    </section>

</widgects>

@if (count($user->signcerts) != 0)
    <section class="hidden">
        <label>Documents</label>
        <grid class="grid grid-cols-3 gap-4">
            @foreach ($user->signcerts as $signcert)
                <widgect>
                    <header>
                        {{ $signcert->name }}
                    </header>
                    <value>
                        <img src="{{ $signcert->image }}">
                        <p class="text-neutral py-2 text-sm">
                            {{ $signcert->description }}
                        </p>
                        <a href="{{ route('cert.show', ['id' => $signcert->id]) }}" class="block text-sm text-primary">Watch document</a>
                    </value>
                    </right>
                    <left class="order-1">
                        <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                            <x-fas-home class="w-[30px] h-[30px] text-primary "></x-fas-home>
                        </icon>
                    </left>
                </widgect>
            @endforeach
        </grid>
    </section>
@endif
