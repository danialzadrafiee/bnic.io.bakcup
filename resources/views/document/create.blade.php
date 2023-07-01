<x-layout.global>
    @vite(['resources/js/document-create.js', 'resources/css/document-create.scss'])
    <style>
        .force_hidden {
            display: none !important;
        }
    </style>
    <main>

        <div class="flex min-h-screen ">

            <navbar class="w-[350px] shrink-0 flex flex-col h-screen  bg-base-content ">
                <header class="bg-[#0c0d0e]  flex items-center text-white h-16">
                    <item class="w-16 h-16  bg-[#1c1b20] fill-white flex items-center justify-center ">
                        <svg class="w-8 h-8" height="20" version="1.1" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <g id="layer1">
                                <path
                                    d="M 10.005859 0.5 A 0.50083746 0.50083746 0 0 0 9.7539062 0.56445312 L 1.7539062 5.0644531 A 0.50083746 0.50083746 0 0 0 1.5 5.5 L 1.5 14.5 A 0.50083746 0.50083746 0 0 0 1.7539062 14.935547 L 9.7539062 19.435547 A 0.50083746 0.50083746 0 0 0 10.246094 19.435547 L 18.246094 14.935547 A 0.50083746 0.50083746 0 0 0 18.5 14.5 L 18.5 5.5 A 0.50083746 0.50083746 0 0 0 18.246094 5.0644531 L 10.246094 0.56445312 A 0.50083746 0.50083746 0 0 0 10.005859 0.5 z M 10 1.5742188 L 16.978516 5.5 L 10 9.4257812 L 3.0214844 5.5 L 10 1.5742188 z M 2.5 6.3554688 L 9.5 10.292969 L 9.5 18.144531 L 2.5 14.207031 L 2.5 6.3554688 z M 17.5 6.3554688 L 17.5 14.207031 L 10.5 18.144531 L 10.5 10.292969 L 17.5 6.3554688 z "
                                    style="fill:white; fill-opacity:1; stroke:none; stroke-width:0px;" />
                            </g>
                        </svg>
                    </item>
                    <span class="pl-6 text-lg ">
                        Form elements
                    </span>
                </header>
                <content class="flex w-full h-full">
                    <icons>
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
                            <svg class="w-7 h-7" class="bi bi-textarea-resize" fill="white" height="16" viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0 4.5A2.5 2.5 0 0 1 2.5 2h11A2.5 2.5 0 0 1 16 4.5v7a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 0 11.5v-7zM2.5 3A1.5 1.5 0 0 0 1 4.5v7A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 13.5 3h-11zm10.854 4.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708l3-3a.5.5 0 0 1 .708 0zm0 2.5a.5.5 0 0 1 0 .708l-.5.5a.5.5 0 0 1-.708-.708l.5-.5a.5.5 0 0 1 .708 0z" />
                            </svg>

                        </item>
                    </icons>
                    <mainbar class="bg-[#1f2124] flex flex-col  w-full h-[100%] ">
                        <elements id="form-elements" class="js-form-elements bg-base-content">
                            <div class="js-element  css_heading  ">
                                <h3 class="js-editable-element text-xl w-max font-semibold " contenteditable="false">Click here and edit me</h3>
                            </div>
                            <div class="js-element  css_p ">
                                <p class="js-editable-element css_para" contenteditable="false">
                                    This is a example paragraph, you can drag it in form creator and write it every thing you want inside this. click here for edit
                                </p>
                            </div>
                            <field class="js-element  flex flex-col  css_input_text" data-field-id="0" data-publicity-creator="false" data-publicity-reciver="false">
                                <publicity class="set-publicity py-3 border border-b-0 rounded-t w-max hidden ">
                                    <div class="flex">
                                        <label class="block px-4 text-sm font-semibold ">Publicity</label>
                                        <label class="flex items-center mr-4">
                                            <input type="checkbox" value="creator" class="js-publicity-checkbox checkbox checkbox-sm ">
                                            <div for="inline-2-checkbox" class="text-sm text-base-content pl-2">
                                                Creator
                                            </div>
                                        </label>
                                        <label class="flex items-center mr-4">
                                            <input type="checkbox" value="reciver" class="js-publicity-checkbox checkbox checkbox-sm">
                                            <div for="inline-checkbox" class="text-sm text-base-content pl-2">
                                                Reciver</div>
                                        </label>
                                    </div>
                                </publicity>
                                <input name="default_name" class="css_input_field appearance-none border border-neutral-5/30 rounded w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 " id="text" type="text"
                                    placeholder="Field Name" name="Field Name" readonly>
                                <input type="text" class="hidden set-name border px-4  ml-auto rounded border-t-0 rounded-t-none text-sm h-12 w-25 border-neutral-5/30" value="Field Name">




                            </field>
                            <field class="js-element  flex flex-col  css_textarea" data-field-id="0" data-publicity-creator="false" data-publicity-reciver="false">
                                <publicity class="set-publicity py-3 border border-b-0  rounded-t w-max hidden ">
                                    <div class="flex">
                                        <label class="block px-4 ">Publicity : </label>
                                        <label class="flex items-center mr-4">
                                            <input type="checkbox" value="creator" class="js-publicity-checkbox checkbox checkbox-sm">
                                            <div for="inline-2-checkbox" class="text-sm text-base-content pl-2">
                                                Creator
                                            </div>
                                        </label>
                                        <label class="flex items-center mr-4">
                                            <input type="checkbox" value="reciver" class="js-publicity-checkbox checkbox checkbox-sm">
                                            <div for="inline-checkbox" class="text-sm text-base-content pl-2">
                                                Reciver</div>
                                        </label>
                                    </div>
                                </publicity>
                                <textarea name="default_name" placeholder="textarea" id="" class="css_input_field w-full py-3 px-2 border border-neutral-5/30 rounded" readonly></textarea>
                                <input type="text" class="hidden set-name border px-4  ml-auto rounded border-t-0 rounded-t-none text-sm h-12 w-25 border-neutral-5/30" value="Long Text">

                            </field>
                        </elements>
                        <information class="block  right-10 bottom-10 bg-[#1f2124] rounded-xl pt-6  mt-auto mb-4  ">
                            <h2 class="pl-4 text-white mb-2 ">Form Information <sup>*</sup></h2>
                            <div class="flex flex-col gap-2 items-center px-4 mb-5 ">
                                <input required type="text" class="js-form-name bg-transparent border text-white text-sm border-white/30 w-full py-2 px-4 placeholder:text-sm placeholder:text-white/60 placeholder:font-normal"
                                    placeholder="Form name *" name="name">
                                <input required type="text" class="js-form-description  bg-transparent border text-white text-sm border-white/30 w-full py-2 px-4 placeholder:text-sm placeholder:text-white/60 placeholder:font-normal"
                                    placeholder="Form description *" name="description">

                                <input type="text" id="reciver" class="js-input-email  bg-transparent border text-white text-sm border-white/30 w-full py-2 px-4 placeholder:text-sm placeholder:text-white/60 placeholder:font-normal"
                                    placeholder="example@gmail.com *" style="display: none" required>
                                <flex class="flex justify-between w-full mt-4 ">
                                    <label class="flex w-full cursor-pointer  items-center justify-between">
                                        <div class="flex">
                                            <input type="checkbox" class="js_reciver_checkbox checkbox checkbox-xs checkbox-primary">
                                            <span class="ml-2 -mt-0.5 text-sm font-medium text-neutral-900 dark:text-neutral-300">Reciver
                                            </span>
                                        </div>
                                    </label>
                                    <button id="submit-form" class="btn btn-primary flex ml-auto btn-sm">Submit</button>
                                </flex>
                            </div>
                        </information>
                    </mainbar>

                </content>

            </navbar>

            <editor class="grow w-full block">
                <div class="w-full h-[65px] flex items-center mb-[54px] bg-[#1f2124]  text-lg text-white font-semibold">
                    <heading class="w-full mx-auto flex max-w-5xl">
                        Drag Form elements here
                    </heading>
                </div>
                <inside class="w-full mx-auto flex max-w-5xl">
                    <div id="form-creator" class="js-form-creator w-full bg-white css_form_creator">
                        <div class="flex flex-col space-y-4">
                        </div>
                        <div class="flex border rounded items-center justify-center flex-col py-4 mt-4 js-remlunch">
                            <row class="text-sm">ADD FORM COLUMN LAYOUT </row>
                            <row class="flex gap-[2px] mt-4">
                                <style>
                                    .css_layout_button:hover icon {
                                        background: #515962 !important;

                                    }
                                </style>
                                <div class="flex css_layout_button cursor-pointer transition-all" id="add-row-cols-1">
                                    <icon class="bg-[#d5d8dc] transition-all w-[90px] flex justify-center items-center h-[46px] mr-2 ">

                                        <x-fas-plus class="text-white font-thin"> </x-fas-plus>
                                    </icon>
                                </div>
                                <div class="flex gap-[4px] css_layout_button cursor-pointer transition-all" id="add-row-cols-2">
                                    <icon class="bg-[#d5d8dc] w-[45px] transition-all items-center justify-center  flex h-[46px] ">
                                        <x-fas-plus class="text-white font-thin"> </x-fas-plus>
                                    </icon>
                                    <icon class="bg-[#d5d8dc] w-[45px]  transition-all items-center justify-center flex h-[46px] ">
                                        <x-fas-plus class="text-white font-thin"> </x-fas-plus>
                                    </icon>
                                </div>
                            </row>

                        </div>
                    </div>
                </inside>

            </editor>
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
                        <column class="flex flex-col   self-end gap-0">
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
