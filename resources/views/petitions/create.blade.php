<x-layout.dashboard :user="auth()->user()">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Create a Petition</h2>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <form action="{{ route('petitions.store') }}" method="post">
                @csrf
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" autocomplete="given-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="hashtag" class="block text-sm font-medium text-gray-700">Hashtag</label>
                            <input type="text" name="hashtag" id="hashtag" autocomplete="family-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content" rows="3" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="end_at" class="block text-sm font-medium text-gray-700">End At</label>
                            <input type="datetime-local" name="end_at" id="end_at" autocomplete="end-date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout.dashboard>
