<x-layout.dashboard :user="auth()->user()">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between mb-8">
            <h2 class="text-2xl font-semibold text-gray-900">Petitions</h2>
            <a href="{{ route('petitions.create') }}" class="btn btn-neutral normal-case">
                <x-fas-plus class="mr-2" /> Create a Petition
            </a>
        </div>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($petitions as $petition)
                <div class="bg-white overflow-hidden flex flex-col shadow rounded-lg">
                    <figure class="relative">
                        @if ($petition->users()->where('user_id', auth()->user()->id)->whereNot('user_role','creator')->exists())
                            <span class="badge absolute right-4 bottom-4 text-white  badge-info">You've signed</span>
                        @endif
                        <img class="h-48 w-full object-cover"
                            src="{{ $petition->picture ?? 'https://api.dicebear.com/6.x/initials/svg?seed=' . $petition->title }}"
                            alt="{{ $petition->title }}">
                    </figure>
                    <div class="p-4">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg  font-medium text-gray-900">{{ $petition->title }}</h3>
                            <span class="badge badge-sm badge-primary capitalize">{{ $petition->type }}</span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">{{ Str::limit($petition->content, 50) }}</p>
                        <p class="mt-3 text-sm border-b py-2 text-gray-500">
                            <start class="flex gap-2 items-center justify-between">
                                <left class="flex items-center gap-2">
                                    <x-fas-hourglass-start></x-fas-hourglass-start>
                                    <span>Start : </span>
                                </left>
                                {{ \Carbon\Carbon::parse($petition->created_at)->diffForHumans() }}
                            </start>
                            <end class="flex gap-2 items-center justify-between">
                                <left class="flex items-center gap-2">
                                    <x-fas-flag-checkered></x-fas-flag-checkered>
                                    <span>End : </span>
                                </left>
                                {{ \Carbon\Carbon::parse($petition->end_at)->diffForHumans() }}
                            </end>
                        </p>

                        @php
                            $creator = $petition
                                ->users()
                                ->wherePivot('user_role', 'creator')
                                ->first();
                            $creator_fullname = $creator->user_type == 'invidual' ? $creator->first_name . ' ' . $creator->last_name : $creator->corp_name;
                            $signed = $petition
                                ->users()
                                ->wherePivot('user_role', 'signer')
                                ->count();
                        @endphp
                        <row class="py-2  flex flex-col ">
                            <p class=" text-sm flex gap-2 justify-between items-center text-gray-500">
                                <left class="flex items-center gap-2">
                                    <x-fas-user />
                                    <span> Created by: </span>
                                </left>
                                {{ $creator_fullname }}
                            </p>
                            <p class=" text-sm flex gap-2 justify-between items-center text-gray-500">
                                <left class="flex items-center gap-2">
                                    <x-fas-signature />
                                    <span> Signed by: </span>
                                </left>
                                {{ $signed }} users
                            </p>
                        </row>

                    </div>
                    <div class="pb-4 mt-auto sm:px-6">
                        <a href="{{ route('petitions.show', $petition) }}" class="btn btn-primary  w-full">
                            <x-fas-eye class="mr-2" /> View Petition
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout.dashboard>
