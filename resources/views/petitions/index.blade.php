<x-layout.dashboard :user="auth()->user()">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between mb-8">
            <h2 class="text-2xl font-semibold text-gray-900">Petitions</h2>
            <a href="{{ route('petitions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                <x-fas-plus class="mr-2" /> Create a Petition
            </a>
        </div>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($petitions as $petition)
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <img class="h-48 w-full object-cover" src="{{ $petition->picture ?? 'https://api.dicebear.com/6.x/shapes/svg?seed=' . $petition->title }}" alt="{{ $petition->title }}">
                    <div class="p-4">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $petition->title }}</h3>
                            @if ($petition->anonymous)
                                <span class="badge badge-sm badge-primary">Anonymous</span>
                            @endif
                        </div>
                        <p class="mt-2 text-sm text-gray-500">{{ Str::limit($petition->content, 50) }}</p>
                        <p class="mt-2 text-sm text-gray-500">Started {{ \Carbon\Carbon::parse($petition->created_at)->diffForHumans() }} and ends {{ \Carbon\Carbon::parse($petition->end_at)->diffForHumans() }}</p>

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
                        <p class="mt-2 text-sm text-gray-500">
                            <x-fas-user class="mr-1" /> Created by: {{ $creator_fullname }}
                        </p>
                        <p class="mt-2 text-sm text-gray-500">
                            <x-fas-users class="mr-1" /> Signed by: {{ $signed }} users
                        </p>
                        @if ($petition->users()->where('user_id', auth()->user()->id)->exists())
                            <span class="badge badge-sm badge-info">You've signed this petition</span>
                        @endif
                    </div>
                    <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
                        <a href="{{ route('petitions.show', $petition) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                            <x-fas-eye class="mr-2" /> View Petition
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout.dashboard>
