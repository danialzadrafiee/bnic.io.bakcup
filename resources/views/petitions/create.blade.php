<x-layout.dashboard :user="auth()->user()">
    @vite('resources/js/petition-create.js')
    <div class="container">
        <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Create a Petition</h2>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <form id="petitionForm" action="{{ route('petitions.store') }}" method="post">
                @csrf
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="title" class="text-sm">Title</label>
                            <input type="text" name="title" id="title" autocomplete="given-name"
                                class="input border border-neutral-5/30 w-full">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="hashtag" class="text-sm">Short describe</label>
                            <input type="text" name="hashtag" id="hashtag" autocomplete="family-name"
                                class="input border border-neutral-5/30 w-full">
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label for="content" class="text-sm">Content</label>
                            <textarea name="content" id="content" rows="3"
                                class="mt-1 block w-full h-96 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                        <grid class="col-span-6  grid grid-cols-3 grid-flow-row gap-4">
                            <cel class="flex flex-col gap-4">
                                <span>Type</span>
                                <div class="flex gap-4 items-center">
                                    <label class="flex items-center gap-2">
                                        <span>Anonymous</span>
                                        <input type="radio" name="type" checked value="anonymous"
                                            class="radio radio-xs radio-primary">
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <span>Transparent</span>
                                        <input type="radio" name="type" value="transparent"
                                            class="radio radio-xs radio-primary">
                                    </label>
                                </div>
                            </cel>
                            <cel>
                                <label>
                                    <span>Minimum Signatures</span>
                                    <input type="number" name="min" class="input w-full border border-neutral-5/30"
                                        min="10" value="10">
                                </label>
                            </cel>
                            <cel>
                                <span>End At</span>
                                <input type="datetime-local" name="end_at" id="end_at" autocomplete="end-date"
                                    class="input w-full border border-neutral-5/30">
                            </cel>
                        </grid>

                    </div>
                </div>
                <div class="px-4 py-3 text-right sm:px-6">
                    <button type="submit" disabled class="js_btn_submit btn btn-neutral">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layout.dashboard>
