<x-layout.dashboard :user="auth()->user()">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h2 class="text-xl leading-6 font-medium text-gray-900">
                    {{ $petition->title }}
                </h2>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Content
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $petition->content }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 flex justify-between items-center">
                        <form action="{{ route('petitions.sign', $petition) }}" method="post">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                <x-fas-user class="mr-2" />
                                Sign this Petition
                            </button>
                        </form>
                        @if (auth()->user()->id ==
                                $petition->users()->wherePivot('user_role', 'creator')->first()->id)
                            <form action="{{ route('petitions.destroy', $petition) }}" method="post">
                                @csrf
                                @method('DELETE')
                                @php
                                    $canDelete =
                                        $petition
                                            ->users()
                                            ->wherePivot('user_role', 'signer')
                                            ->count() < 10;
                                    $errorMessage = $errors->first('error') ?? '';
                                @endphp

                                <tooltip class="{{ $canDelete && 'tooltip' }}" data-tip="{{ $errorMessage }}">
                                    <button type="submit"
                                        class="{{ $canDelete ? 'inline-flex' : 'opacity-50 cursor-not-allowed' }} items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700">
                                        <x-fas-trash-alt class="mr-2" />
                                        Delete this Petition
                                    </button>
                                </tooltip>

                            </form>
                        @endif
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-layout.dashboard>
