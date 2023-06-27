<x-layout.global>
    @vite(['resources/js/document-create.js', 'resources/css/document-create.scss'])
    <style>
        .force_hidden {
            display: none !important;
        }
    </style>
    <main class="">
        <div class="  mx-auto ">
            <header class="grid hidden gap-8 grid-cols-2">
                <cel>

                    <h1 class="text-xl font-bold mb-2">Drag and Drop Form Creator</h1>
                    <p class="mb-8 text-sm ">This is a simple form creator that allows you to drag and drop form elements
                        into a form
                        creator. You can also edit the form elements and add them to the form creator</p>
                </cel>
                <cel>
                    <h2 class="text-2xl font-semibold mb-3">Form Information:</h2>
                    <div class="flex flex-col gap-4 items-center bg-white rounded p-6 mb-5 shadow">
                        <input required type="text" class="js-form-name  border border-neutral-200 rounded p-3 w-full  border-neutral/50 " placeholder="Form name" name="name">
                        <input required type="text" class="js-form-description  border border-neutral-200 rounded p-3 w-full  border-neutral/50 " placeholder="Form description" name="description">
                        <div class="flex items-center gap-4 justify-between w-full ">
                            <checkbox>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" value="" checked class="sr-only peer js-publicity-check">
                                    <div
                                        class="w-11 h-6 bg-neutral/30 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-neutral-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-neutral-600 peer-checked:bg-blue-600">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-neutral-900 dark:text-neutral-300">Reciver
                                        [Third person]
                                    </span>
                                </label>
                            </checkbox>
                            <reciver class="flex-grow">
                                <input type="text" id="first_name" class="js-input-email appearance-none border border-neutral/50 rounded w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="example@gmail.com" required>
                            </reciver>
                        </div>
                    </div>
                </cel>
            </header>
            <div class="grid grid-cols-6 min-h-screen bg-neutral-3 gap-8">

                <column class="col-span-2 flex flex-col  bg-base-content ">
                    <header class="bg-[#2f333a] text-lg font-bold px-[6.6rem] flex items-center text-white h-16">
                        Form elements
                    </header>
                    <flex class="flex w-full">
                        <cel>
                            <item class="bg-[#37404a]  w-16 h-16 border-b border-white/20 fill-white flex items-center justify-center ">
                                <svg class="p-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M448 456c0 13.25-10.75 24-24 24h-112C298.8 480 288 469.3 288 456s10.75-24 24-24h32V280h-240v152h32C149.3 432 160 442.8 160 456S149.3 480 136 480h-112C10.75 480 0 469.3 0 456s10.75-24 24-24h32v-352h-32C10.75 80 0 69.25 0 56S10.75 32 24 32h112C149.3 32 160 42.75 160 56S149.3 80 136 80h-32v152h240V80h-32C298.8 80 288 69.25 288 56S298.8 32 312 32h112C437.3 32 448 42.75 448 56S437.3 80 424 80h-32v352h32C437.3 432 448 442.8 448 456z" />
                                </svg>
                            </item>
                            <item class="bg-[#37404a] w-16 h-16 border-b border-white/20  fill-white flex items-center justify-center ">
                                <svg class="p-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M424 296H23.1C10.75 296 0 306.7 0 320S10.75 344 23.1 344H424c13.25 0 24-10.75 24-23.1S437.3 296 424 296zM424 424H23.1C10.75 424 0 434.7 0 448S10.75 472 23.1 472H424c13.25 0 24-10.75 24-23.1S437.3 424 424 424zM424 168H23.1C10.75 168 0 178.7 0 192S10.75 216 23.1 216H424c13.25 0 24-10.75 24-23.1S437.3 168 424 168zM424 40H23.1C10.75 40 0 50.75 0 64S10.75 88 23.1 88H424c13.25 0 24-10.75 24-23.1S437.3 40 424 40z" />
                                </svg>
                            </item>
                            <item class="bg-[#37404a] w-16 h-16 border-b border-white/20  fill-white flex items-center justify-center ">
                                <svg class="p-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <path
                                        d="M213.5 172.2c-8.123-16.31-34.81-16.31-42.94 0l-71.1 144c-5.938 11.84-1.125 26.25 10.75 32.19c11.9 5.938 26.25 1.156 32.19-10.75l5.359-10.72h90.34l5.359 10.72c4.219 8.438 12.69 13.28 21.5 13.28c3.594 0 7.25-.8125 10.69-2.531c11.88-5.938 16.69-20.34 10.75-32.19L213.5 172.2zM170.8 278.1L192 236.6l21.17 42.34H170.8zM456 220C456 186.9 429.1 160 396 160H344C330.8 160 320 170.8 320 184v144c0 13.25 10.75 24 24 24h68c33.09 0 60-26.91 60-60c0-18.59-8.5-35.23-21.81-46.25C453.9 237.1 456 229.2 456 220zM368 208h28c6.625 0 12 5.391 12 12S402.6 232 396 232H368V208zM412 304H368V280h44c6.625 0 12 5.391 12 12C424 298.6 418.6 304 412 304zM576 64H63.1C28.65 64 0 92.65 0 128v256c0 35.35 28.65 64 63.1 64H576C611.3 448 640 419.3 640 384V128C640 92.65 611.3 64 576 64zM592 384c0 8.836-7.164 16-16 16H63.1c-8.836 0-16-7.164-16-16V128c0-8.838 7.164-16 16-16H576c8.836 0 16 7.162 16 16V384z" />
                                </svg>
                            </item>
                            <item class="bg-[#37404a] w-16 h-16 border-b border-white/20  fill-white flex items-center justify-center ">
                                <svg class="p-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <path
                                        d="M320 248v48C320 309.3 330.8 320 344 320s24-10.75 24-24V272h88v160h-32c-13.25 0-24 10.75-24 24S410.8 480 424 480h112c13.25 0 24-10.75 24-24s-10.75-24-24-24h-32v-160h88v24c0 13.25 10.75 24 24 24S640 309.3 640 296v-48C640 234.8 629.3 224 616 224h-272C330.8 224 320 234.8 320 248zM0 56l0 80C0 149.3 10.75 160 24 160S48 149.3 48 136V80h120v352h-48C106.8 432 96 442.8 96 456S106.8 480 120 480h144C277.3 480 288 469.3 288 456S277.3 432 264 432h-48v-352h120v56C336 149.3 346.8 160 360 160S384 149.3 384 136v-80C384 42.75 373.3 32 360 32H24C10.75 32 0 42.75 0 56z" />
                                </svg>

                            </item>
                        </cel>
                        <cel class="bg-[#37404a] w-full">
                            <h2 class="text-lg hidden font-semibold text-white mb-3">Drag Element From here</h2>
                            <div id="form-elements" class="js-form-elements">
                                <div class="js-element  css_heading  ">
                                    <h3 class="js-editable-element text-xl font-semibold " contenteditable="false">Heading</h3>
                                </div>
                                <div class="js-element  css_p ">
                                    <p class="js-editable-element " contenteditable="false">
                                        This is a example paragraph, you can drag it in form creator and write it every thing you want inside this
                                    </p>
                                </div>


                                <field class="js-element  flex flex-col  css_input_text" data-field-id="0" data-publicity-creator="false" data-publicity-reciver="false">
                                    <input name="default_name" class="appearance-none border border-neutral/50 rounded w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 " id="text" type="text"
                                        placeholder="text-field-1" name="text-field-1" readonly>
                                    <input type="text" class="hidden set-name ml-auto rounded border-t-0 rounded-t-none text-sm h-8 w-25 border-neutral/50" value="text-field-1">


                                    <publicity class="set-publicity -mt-8 w-max hidden py-2">
                                        <div class="flex">
                                            <label class="block px-4 ">Publicity : </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="creator"
                                                    class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-2-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Creator
                                                </div>
                                            </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="reciver"
                                                    class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Reciver</div>
                                            </label>
                                        </div>
                                    </publicity>

                                </field>
                                <field class="js-element  flex flex-col  css_textarea" data-field-id="0" data-publicity-creator="false" data-publicity-reciver="false">
                                    <textarea name="default_name" placeholder="textarea" id="" class="w-full py-3 px-2 border border-neutral/50 rounded" readonly></textarea>
                                    <input type="text" class="hidden set-name ml-auto rounded border-t-0 rounded-t-none text-sm h-8 w-25 border-neutral/50" value="text-area-1">
                                    <publicity class="set-publicity -mt-8 w-max hidden py-2">
                                        <div class="flex">
                                            <label class="block px-4 ">Publicity : </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="creator"
                                                    class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-2-checkbox" class="ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Creator
                                                </div>
                                            </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="reciver"
                                                    class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-checkbox" class="ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Reciver</div>
                                            </label>
                                        </div>
                                    </publicity>
                                </field>
                            </div>
                        </cel>
                    </flex>

                </column>

                <div class="col-span-4 p-32">
                    {{-- <header>
                        <h2 class="text-xl font-semibold mb-3">Drag elements To here</h2>
                    </header> --}}
                    <div id="form-creator" class="js-form-creator bg-white p-4  rounded shadow">
                        <div class="flex flex-col space-y-4">
                        </div>
                        <flex class="flex mt-4 js-remlunch">
                            <button id="add-row-cols-1" class="bg-blue-500 text-white  px-4 py-2 rounded mr-2 ">Add
                                1-column row</button>
                            <button id="add-row-cols-2" class="bg-blue-500 text-white  px-4 py-2 rounded ">Add 2-column
                                row</button>
                            <button id="submit-form" disabled class="bg-primary text-white bg-opacity-40 px-4 py-2 rounded block ml-auto ">submit</button>
                        </flex>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <modal class="js-modal-select-user w-screen h-screen bg-black/80 fixed inset-0 m-auto z-10 flex flex-col items-center justify-center" style="display:none">
        <inside class="w-[950px]  rounded flex-col flex bg-white">
            <header class="flex items-center p-4 justify-between">
                <heading class="text-lg">Search and select user</heading>
                <searchbox class="flex">
                    <input type="text" class="js-input-search bg-neutral/5 rounded rounded-r-none border border-neutral/20 px-4 py-2" placeholder="Search user">
                    <button class="js-btn-search bg-primary/80 hover:bg-primary rounded-r text-white text-sm text-center p-2">Search</button>
                </searchbox>
            </header>
            <section class="js-section-search-result p-4 overflow-y-auto h-[500px]">
                @foreach ($modal_users as $user)
                    <user class="js-row-user rounded border-b py-4  border-neutral/20 flex gap-4 flex-row w-full  ">
                        <column class="flex shrink-0 w-[84px] h-[84px]">
                            <img src="https://api.dicebear.com/6.x/identicon/svg?seed={{ $user->email }}" class="js-search-user-image w-[84px] h-[84px] block rounded bg-neutral/10 p-2">
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
                            <button class="js-btn-select-user bg-primary/80 hover:bg-primary rounded text-white text-center text-xs p-2" data-email="{{ $user->email }}">Select</button>
                        </column>
                    </user>
                @endforeach
            </section>
        </inside>
    </modal>
</x-layout.global>
<hidden class="h-24min-h-"></hidden>
