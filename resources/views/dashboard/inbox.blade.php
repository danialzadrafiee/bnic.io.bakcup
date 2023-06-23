@php
    $me = auth()->user();
    $user_type = $me->user_type;
@endphp



<x-layout.dashboard :user="$me">

    @vite(['resources/js/inbox.js'])
    <input type="hidden" name="user_id" value="{{ $me->id }}" class="js-user-id">


    <main class="w-full @container/inbox ">
        <grid class="grid w-full grid-cols-1 rounded-xl  ">
            <reciver>
                <header class="font-medium px-3 pt-3">
                    Observer Requests
                </header>
                <describe class="px-3 text-sm font-light">
                    Your role is reciver
                </describe>
                <content class="js-certificate-recived p-3 w-full grid grid-cols-2 @[800px]/inbox:grid-cols-3 mt-4 gap-6">
                    @include('dashboard/inbox/card', ['certs' => $requester_certs])
                </content>
            </reciver>
            <requester class="flex flex-col">
                <header class="font-medium px-3 pt-3">
                    Sent Requests
                </header>
                <describe class="px-3 text-sm font-light">
                    Your role is Requester
                </describe>
                <content class="js-certificate-recived w-full grid grid-cols-2 @[800px]/inbox:grid-cols-3 mt-4 gap-6">
                    @include('dashboard/inbox/card', ['certs' => $reciver_certs])
                </content>
            </requester>

            @if (auth()->user()->user_type == 'corporation')
                <creator class="flex flex-col">
                    <header class=" font-medium px-3 pt-3">
                        Owned Requests
                    </header>
                    <describe class="px-3 text-sm font-light">
                        Your role is creator corporation
                    </describe>
                    <content class="js-certificate-recived w-full grid grid-cols-2 @[800px]/inbox:grid-cols-3 mt-4 gap-6">
                        @include('dashboard/inbox/card', ['certs' => $creator_certs])
                    </content>
                </creator>
            @endif
        </grid>
    </main>
</x-layout.dashboard>
