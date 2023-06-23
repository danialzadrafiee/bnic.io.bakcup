<widgects user-type="corporation">
    <section>
        <label>Corporation information</label>
        <grid class="grid grid-cols-3">
            <widgect class="_fullname">
                <header>
                    Name
                </header>
                <value>
                    <span>{{ $user->corp_name }}</span>
                </value>
            </widgect>

            <widgect class="_nationality-primary">
                <header>
                    NATIONALITY PRIMARY
                </header>
                <value>
                    {{ $user->{"corp_country_pri"} }}
                    {{ $user->{"corp_state_pri"} }}
                </value>
            </widgect>

            @if ($user->{"corp_country_sec"})
                <widgect class="_nationality-secondary">
                    <header>
                        NATIONALITY SECONDARY
                    </header>
                    <value> {{ $user->{"corp_country_sec"} }}
                        {{ $user->{"corp_state_sec"} }}</value>
                </widgect>
            @endif

        </grid>
    </section>
    <section>
        <label>Corporation Category</label>
        <grid class="grid grid-cols-3">
            <widgect class="_category-pri">
                <header>
                    PRIMARY CATEGORY
                </header>
                <value>
                    {{ $user->{"corp_cat_pri"} }}
                </value>
            </widgect>
            <widgect class="_category-sec">
                <header>
                    SECONDARY CATEGORY
                </header>
                <value>
                    {{ $user->{"corp_cat_sec"} }}
                </value>
            </widgect>
            <widgect class="_form">
                <header>
                    FORM
                </header>
                <value>
                    {{ $user->{"corp_form"} }}
                </value>
            </widgect>
        </grid>
    </section>
    <section>
        <label>Introdoction details</label>
        <grid class="grid grid-cols-1">
            <widgect class="_code">
                <header>
                    Describe
                </header>
                <value>
                    {!! $user->corp_cv !!}
                </value>
            </widgect>
        </grid>
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
                    <a href="{{ route('document.create') }}" class="text-primary">Create
                        Documention</a>
                </value>
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
            </widgect>
        @endforeach
    </grid>
</section>
@endif