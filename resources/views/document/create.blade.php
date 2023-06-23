<x-layout.global>
    @vite(['resources/js/document-create.js', 'resources/css/document-create.scss'])
    <style>
        .force_hidden {
            display: none !important;
        }
    </style>
    <main>
        <div class="container mx-auto my-10">
            <h1 class="text-3xl font-bold mb-2">Drag and Drop Form Creator</h1>
            <p class="mb-8">This is a simple form creator that allows you to drag and drop form elements
                into a form
                creator. You can also edit the form elements and add them to the form creator</p>
            <div class="grid grid-cols-2 gap-8">
                <column>
                    <row>

                        <h2 class="text-2xl font-semibold mb-3">Form elements:</h2>
                        <div id="form-elements" class="js-form-elements bg-white p-4 rounded shadow">

                            <div class="js-element p-2 my-2  rounded">
                                <h3 class="js-editable-element text-xl font-semibold" contenteditable="false">Heading</h3>
                            </div>
                            <div class="js-element p-2 my-2  rounded">
                                <p class="js-editable-element" contenteditable="false">Paragraph</p>
                            </div>


                            <field class="js-element p-2 my-2 flex flex-col rounded" data-field-id="0"
                                data-publicity-creator="false" data-publicity-reciver="false">
                                <input name="default_name"
                                    class="appearance-none border border-neutral/50 rounded w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    id="text" type="text" placeholder="text-field-1" name="text-field-1"
                                    readonly>
                                <input type="text"
                                    class="hidden set-name ml-auto rounded border-t-0 rounded-t-none text-sm h-8 w-25 border-neutral/50"
                                    value="text-field-1">


                                <publicity class="set-publicity -mt-8 w-max hidden py-2">
                                    <div class="flex">
                                        <label class="block px-4 ">Publicity : </label>
                                        <label class="flex items-center mr-4">
                                            <input type="checkbox" value="creator"
                                                class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                            <div for="inline-2-checkbox"
                                                class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                Creator
                                            </div>
                                        </label>
                                        <label class="flex items-center mr-4">
                                            <input type="checkbox" value="reciver"
                                                class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                            <div for="inline-checkbox"
                                                class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                Reciver</div>
                                        </label>
                                    </div>
                                </publicity>

                            </field>
                            <field class="js-element p-2 my-2 flex flex-col rounded" data-field-id="0"
                                data-publicity-creator="false" data-publicity-reciver="false">
                                <textarea name="default_name" placeholder="textarea" id=""
                                    class="w-full py-3 px-2 border border-neutral/50 rounded" readonly></textarea>
                                <input type="text"
                                    class="hidden set-name ml-auto rounded border-t-0 rounded-t-none text-sm h-8 w-25 border-neutral/50"
                                    value="text-area-1">
                                <publicity class="set-publicity -mt-8 w-max hidden py-2">
                                    <div class="flex">
                                        <label class="block px-4 ">Publicity : </label>
                                        <label class="flex items-center mr-4">
                                            <input type="checkbox" value="creator"
                                                class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                            <div for="inline-2-checkbox"
                                                class="ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                Creator
                                            </div>
                                        </label>
                                        <label class="flex items-center mr-4">
                                            <input type="checkbox" value="reciver"
                                                class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                            <div for="inline-checkbox"
                                                class="ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                Reciver</div>
                                        </label>
                                    </div>
                                </publicity>
                            </field>
                        </div>
                    </row>
                    <row class="mt-8 block">

                        <h2 class="text-2xl font-semibold mb-3">Form Information:</h2>
                        <div class="flex flex-col gap-4 items-center bg-white rounded p-6 mb-5 shadow">
                            <input required type="text"
                                class="js-form-name  border border-neutral-200 rounded p-3 w-full  border-neutral/50 "
                                placeholder="Form name" name="name">
                            <input required type="text"
                                class="js-form-description  border border-neutral-200 rounded p-3 w-full  border-neutral/50 "
                                placeholder="Form description" name="description">
                            <div class="flex items-center gap-4 justify-between w-full ">
                                <checkbox>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" checked
                                            class="sr-only peer js-publicity-check">
                                        <div
                                            class="w-11 h-6 bg-neutral/30 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-neutral-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-neutral-600 peer-checked:bg-blue-600">
                                        </div>
                                        <span
                                            class="ml-3 text-sm font-medium text-neutral-900 dark:text-neutral-300">Reciver
                                            [Third person]
                                        </span>
                                    </label>
                                </checkbox>
                                <reciver class="flex-grow">
                                    <input type="text" id="first_name"
                                        class="js-input-email appearance-none border border-neutral/50 rounded w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="example@gmail.com" required>
                                </reciver>
                            </div>
                        </div>
                    </row>
                </column>

                <div>
                    <h2 class="text-2xl font-semibold mb-3">Form creator:</h2>
                    <div id="form-creator" class="js-form-creator bg-white p-4  rounded shadow">
                        <div class="flex flex-col space-y-4">
                        </div>
                        <flex class="flex mt-4 js-remlunch">
                            <button id="add-row-cols-1" class="bg-blue-500 text-white  px-4 py-2 rounded mr-2 ">Add
                                1-column row</button>
                            <button id="add-row-cols-2" class="bg-blue-500 text-white  px-4 py-2 rounded ">Add 2-column
                                row</button>
                            <button id="submit-form" disabled
                                class="bg-primary text-white bg-opacity-40 px-4 py-2 rounded block ml-auto ">submit</button>
                        </flex>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <modal
        class="js-modal-select-user w-screen h-screen bg-black/80 fixed inset-0 m-auto z-10 flex flex-col items-center justify-center"
        style="display:none">
        <inside class="w-[950px]  rounded flex-col flex bg-white">
            <header class="flex items-center p-4 justify-between">
                <heading class="text-lg">Search and select user</heading>
                <searchbox class="flex">
                    <input type="text"
                        class="js-input-search bg-neutral/5 rounded rounded-r-none border border-neutral/20 px-4 py-2"
                        placeholder="Search user">
                    <button
                        class="js-btn-search bg-primary/80 hover:bg-primary rounded-r text-white text-sm text-center p-2">Search</button>
                </searchbox>
            </header>
            <section class="js-section-search-result p-4 overflow-y-auto h-[500px]">
                @foreach ($modal_users as $user)
                    <user class="js-row-user rounded border-b py-4  border-neutral/20 flex gap-4 flex-row w-full  ">
                        <column class="flex shrink-0 w-[84px] h-[84px]">
                            <img src="https://api.dicebear.com/6.x/identicon/svg?seed={{ $user->email }}"
                                class="js-search-user-image w-[84px] h-[84px] block rounded bg-neutral/10 p-2">
                        </column>
                        <column class="flex flex-col  self-end gap-0">
                            <name>
                                <span class="js-search-user-first-name"> {{ $user->first_name }} </span>
                                <span class="js-search-user-last-name"> {{ $user->last_name }} </span>
                            </name>
                            <wallet class="js-search-user-wallet text-neutral text-sm">{{ $user->wallet }}</wallet>
                            <email class="js-search-user-email text-neutral text-sm">{{ $user->email }}</email>
                            <code class="text-neutral text-sm js-search-user-code">
                                {{ $user->gender[0] }}-{{ substr(hash('sha256', $user->email), 0, 8) }}-{{ $user->id }}</code>
                        </column>
                        <column class="flex flex-col  self-center">
                            <about class="js-search-user-cv text-sm text-neutral">
                                {!! strlen(strip_tags($user->cv)) > 90 ? substr(strip_tags($user->cv), 0, 90) . '..' : strip_tags($user->cv) !!}
                            </about>
                        </column>
                        <column class="self-start">
                            <button
                                class="js-btn-select-user bg-primary/80 hover:bg-primary rounded text-white text-center text-xs p-2"
                                data-email="{{ $user->email }}">Select</button>
                        </column>
                    </user>
                @endforeach
            </section>
        </inside>
    </modal>
</x-layout.global>
<hidden class="h-24min-h-"></hidden>
