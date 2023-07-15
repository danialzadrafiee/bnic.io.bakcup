@php
    $me = auth()->user();
@endphp

<x-layout.dashboard :user="$me">
    @vite('resources/js/event-show.js')
    @vite('resources/css/leaflet.scss')
    <main class="w-full flex rounded-xl bg-white p-8 flex-col gap-4 js_event_dom">
        <input type="hidden" class="js_event_id" value="{{ $event->id }}">
        <header class="flex justify-between w-full items-center">
            <event_title class="text-lg font-semibold">{{ $event->title }}</event_title>
            <event_badges class="flex space-x-4 ">
                @if ($event->type == 'private')
                    <span class="badge  text-white badge-neutral">
                        <x-fas-lock class="w-3 mr-1 h-3" /> Private
                    </span>
                @endif
                <span class="badge text-white badge-info">
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
        <row>
            @php
                $lng = explode(',', str_replace(['LatLng', '(', ')'], '', $event->lng_location));
            @endphp

            <label class="block  text-neutral-700 mb-2 mt-6">Event location </label>
            <div id="mapid" class="rounded-xl"></div>
        </row>
        <label class="text-sm mt-4">Accurate address information.</label>
        <textarea class="js-accurate-location w-full textarea !border !border-neutral-5/30" readonly name="accurate_location">{{ $event->accurate_location }}</textarea>
        <footer class="flex  mt-6 justify-between items-center">
            <div>
                Date and time : {{ \Carbon\Carbon::parse($event->time)->format('d M, Y') }}
            </div>
            @if ($event->token == null)
                <button class="js_generate_event_nft btn btn-sm btn-neutral w-max flex">Generate NFT</button>
            @else
                <button class="btn pointer-events-none btn-sm btn-success w-max flex">Event is on blockchain</button>
            @endif

        </footer>
        </grid>
        <users class="col-span-2  js-invite-list-section grid grid-cols-1 gap-2 grow h-max" style="display: none">
            <row class="grid grid-cols-1 w-full">
                <column class="col-span-1 items-center">
                    <heading class="text-lg font-semibold">Invite list</heading>
                    <row class="grid py-3 grid-flow-row gap-4 js-selected-users">
                        <button class="btn btn-sm btn-neutral border bg-transparent text-neutral-300 cursor-pointer border-neutral-300 h-max rounded-lg p-3.5 flex items-center justify-center js_show_user_select_modal">
                            <x-fas-plus></x-fas-plus>
                        </button>
                    </row>

                </column>

            </row>

        </users>
    </main>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #mapid {
            height: 500px;
            width: 100%;
        }
    </style>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Setting view of map
        let map = L.map('mapid').setView([{{ $lng[0] }}, {{ $lng[1] }}], 19);

        // Adding tile layer to map
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

        // Adding marker
        let marker = L.marker([{{ $lng[0] }}, {{ $lng[1] }}]).addTo(map);
    </script>
</x-layout.dashboard>
