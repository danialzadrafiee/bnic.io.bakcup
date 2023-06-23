@php
    $me = auth()->user();
@endphp
@vite('/resources/js/event-show.js');
<x-layout.dashboard :user="$me">

    <main class="w-full flex rounded-xl bg-white p-8 flex-col gap-4">
        <header class="flex justify-between w-full items-center">
            <event_title class="text-lg font-semibold">{{ $event->title }}</event_title>
            <event_badges class="flex space-x-4 ">
                @if ($event->type == 'private')
                    <span class="badge badge-neutral">
                        <x-fas-lock class="w-3 mr-1 h-3" /> Private
                    </span>
                @endif
                <span class="badge badge-info">
                    <x-fas-user class="w-3 mr-1 h-3" /> Creator
                </span>
            </event_badges>
        </header>
        <figure>
            <img data-fancybox="gallery" class="w-full h-56 object-cover rounded-xl object-bottom" src="{{ $event->image }}">
        </figure>
        <content>
            {{ $event->content }}
        </content>
    </main>
</x-layout.dashboard>
