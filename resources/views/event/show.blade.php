@php
    $me = auth()->user();
@endphp
@vite('/resources/js/event-show.js');
@vite('/resources/css/leaflet.scss');
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
            <img data-fancybox="gallery" class="w-full h-56 object-cover rounded-xl object-bottom"
                src="{{ $event->image }}">
        </figure>
        <content>
            {{ $event->content }}
        </content>
        <row>
            @php
                $lng = $event->lng_location;
                $lng = explode(',', $lng);
            @endphp

            <label class="block  text-neutral-700 mb-2 mt-6">Select Location <sup class="text-error">*</sup></label>
            <div id="mapid"></div>
        </row>
        <label class="text-sm mt-4">Accurate address information.</label>
        <textarea class="js-accurate-location w-full textarea !border !border-neutral-5/30" readonly name="accurate_location">{{ $event->accurate_location }}</textarea>
        <footer class="flex  mt-6 justify-between">
            <div class="col-span-6 sm:col-span-3">
                <input type="datetime-local" value="{{ $event->time }}" readonly name="date" id="date"
                    autocomplete="date"
                    class="js-event-date mt-1 block w-full py-2 px-3 border rounded-bl-none border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <label for="date"
                    class="block px-3 text-xs w-max py-2 rounded-t-none border border-t-0 rounded-lg border-neutral-5/30 font-medium text-gray-700">Event
                    Time</label>
            </div>
            <tooltip class="js-create-invite-tooltip tooltip" data-tip="Please fill all required fields">
                <button class="js-create-invite ml-auto flex btn btn-primary">Create event</button>
            </tooltip>
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
        let map = L.map('mapid').setView([{{ $lng[1] }}, {{ $lng[0] }}], 19);

        // Adding tile layer to map
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

        // Adding marker
        let marker = L.marker([{{ $lng[1] }}, {{ $lng[0] }}]).addTo(map);
    </script>
</x-layout.dashboard>

