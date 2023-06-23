@php
    $me = auth()->user();
@endphp
<x-layout.dashboard :user="$me" >
    <main class="flex flex-col gap-4 @container">
        <header class="flex items-center justify-between">
            <flex class="flex gap-4 items-center ">
                <heading class="text-lg font-semibold">
                    Events explorer
                </heading>
                <create>
                    <a href="{{ route('event.create') }}" class="btn btn-neutral btn-sm hover:btn-primary">Create</a>
                </create>
            </flex>
            <filter>

                <form action="{{ route('event.index') }}">
                    <div class="flex items-center gap-2">
                        <div class="tabs tabs-boxed">
                            <a href="{{ route('event.index', ['filter' => 'invited']) }}" class="tab {{ request('filter') == 'invited' ? 'tab-active' : '' }}">Invited</a>

                            <a href="{{ route('event.index', ['filter' => 'created']) }}" class="tab {{ request('filter') == 'created' ? 'tab-active' : '' }}">Created</a>

                            <a href="{{ route('event.index', ['filter' => '']) }}" class="tab {{ request('filter') == '' ? 'tab-active' : '' }}">All</a>
                        </div>
                    </div>
                </form>
            </filter>


        </header>
        <cards id="eventListContainer" class="grid grid-cols-2 gap-4 @[900px]:grid-cols-3">
            @foreach ($created_events as $event)
                <card class="card bg-base-100 shadow-xl">
                    <figure class="relative ">
                        <img src="{{ $event->image }}" class="h-[250px] w-full object-cover" alt="Item image" />
                        <top_badges class="flex space-x-4 top-4 right-4 absolute">
                            @if ($event->type == 'private')
                                <span class="badge badge-warning">
                                    <x-fas-lock class="w-3 mr-1 h-3" /> Private
                                </span>
                            @endif
                            <span class="badge badge-info">
                                <x-fas-user class="w-3 mr-1 h-3" /> Creator
                            </span>
                        </top_badges>
                        <calendar class="bottom-4 right-4 absolute">
                            <span class="badge badge-primary">
                                <x-fas-clock class="w-3 mr-1 h-3" /> {{ $event->created_at->diffForHumans() }}
                            </span>
                        </calendar>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $event->title }}</h2>
                        <p>{{ Str::limit($event->content, 200) }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('event.show', ['event_id' => $event->id]) }}" class="btn btn-neutral hover:btn-primary btn-sm mt-5" data-id="{{ $event->id }}">
                                <x-fas-eye class="w-3 mr-1 h-3" /> Watch Event
                            </a>
                        </div>
                    </div>
                </card>
            @endforeach

            @foreach ($guested_events as $event)
                <card class="card bg-base-100 shadow-xl">
                    <figure class="relative ">
                        <img src="{{ $event->image }}" class="h-[250px] w-full object-cover" alt="Item image" />
                        <top_badges class="flex space-x-4 top-4 right-4 absolute">
                            @if ($event->type == 'private')
                                <span class="badge badge-warning">
                                    <x-fas-lock class="w-3 mr-1 h-3" /> Private
                                </span>
                            @endif
                            <span class="badge badge-info">
                                <x-fas-user class="w-3 mr-1 h-3" /> Invited
                            </span>
                        </top_badges>
                        <calendar class="bottom-4 right-4 absolute">
                            <span class="badge badge-primary">
                                <x-fas-clock class="w-3 mr-1 h-3" /> {{ $event->created_at->diffForHumans() }}
                            </span>
                        </calendar>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $event->title }}</h2>
                        <p>{{ Str::limit($event->content, 200) }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('event.show', ['event_id' => $event->id]) }}" class="btn btn-neutral hover:btn-primary btn-sm mt-5" data-id="{{ $event->id }}">
                                <x-fas-eye class="w-3 mr-1 h-3" /> Watch Event
                            </a>
                        </div>
                    </div>
                </card>
            @endforeach
        </cards>

    </main>
</x-layout.dashboard>
