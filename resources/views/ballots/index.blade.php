@php
    $me = auth()->user();
@endphp
<x-layout.dashboard :user="$me">

    <main class="container mx-auto flex flex-col gap-2 ">

        <header class="flex justify-between py-2 items-center">
            <h1 class="text-xl font-semibold">Voting ballots</h1>
            @if (count($ballots) !== 0)
                <a href="{{ route('ballots.create') }}" class="btn   btn-neutral btn-sm text-white rounded-lg">Create new
                    one</a>
            @endif
        </header>

        @if (count($ballots) != 0)
            @foreach ($ballots as $ballot)
                @php
                    $creator = $ballot
                        ->users()
                        ->where('role', 'creator')
                        ->first();
                    $voters = $ballot
                        ->users()
                        ->where('role', 'voter')
                        ->get();
                @endphp
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="grid grid-cols-2 gap-4 p-6">
                        <div>
                            <h3 class="text-xl font-semibold">{{ $ballot->title }}</h3>
                            <div class="mt-2">
                                @if ($ballot->type == 'private')
                                    <span class="badge badge-error">
                                        Private
                                    </span>
                                @else
                                    <span class="badge badge-accent">
                                        Public
                                    </span>
                                @endif

                                @if ($ballot->anonymous)
                                    <span class="badge badge-info">
                                        Anonymous
                                    </span>
                                @else
                                    <span class="badge text-white badge-info">
                                        Transparent
                                    </span>
                                @endif
                            </div>
                            <p class="mt-2 text-gray-700">{{ $ballot->description }}</p>
                        </div>
                        <div class="space-y-2">
                            <p class="flex justify-between"><span>Created At:</span><span
                                    class="font-medium">{{ $ballot->created_at->diffForHumans() }}</span></p>
                            <p class="flex justify-between"><span>End Date:</span><span
                                    class="font-medium">{{ date('F j, Y, g:i A', strtotime($ballot->ending_date)) }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img class="h-8 w-8 rounded-full"
                                src="https://api.dicebear.com/6.x/identicon/svg?seed=Adler&backgroundType=solid,gradientLinear&backgroundColor=cbe5fe&rowColor=0084ff"
                                alt="">
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $creator->first_name }} {{ $creator->last_name }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    Creator
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex space-x-1">
                                @foreach ($voters->take(6) as $voter)
                                    <img class="h-6 w-6 rounded-full"
                                        src="https://api.dicebear.com/6.x/identicon/svg?seed=Adler&backgroundType=solid,gradientLinear&backgroundColor=cbe5fe&rowColor=0084ff"
                                        alt="">
                                @endforeach
                                @if ($voters->count() > 6)
                                    <span
                                        class="inline-flex items-center justify-center h-6 w-6 rounded-full btn btn-primary text-white text-xs">
                                        +{{ $voters->count() - 6 }}
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('ballots.show', $ballot) }}"
                                class="px-4 py-2 btn btn-primary text-white rounded-lg">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="btn btn-primary text-white rounded-xl shadow-md p-6 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>No voting box exists yet, do you want create first one?</span>
                </div>
                <a href="{{ route('ballots.create') }}" class="btn hover:bg-white bg-white  btn-primary">Create</a>
            </div>
        @endif

    </main>

</x-layout.dashboard>
