<x-layout.auth>
    @vite('resources/js/auth-edit.js')
    @vite('resources/js/auth-register.js')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }

        select,
        option {
            background: #710e0e00 !important;
            border: 1px solid #710e0e00 !important;
        }

        .js-left-step.active svg {
            color: #5956e9;
        }

        .js-left-step.done svg {
            color: #3dd598 !important;
        }

        .js-left-step.wait {
            opacity: 0.5;
        }
    </style>
    <main class="relative flex min-h-screen overflow-hidden">

        <background class="h-screen min-w-[50vw] pointer-events-none -z-50 absolute right-0 top-0 max-h-screen">
            <img class="block h-screen pointer-events-none -z-50 absolute right-0 top-0 max-h-screen"
                src="{{ asset('img/auth/register-right.webp') }}" />
        </background>
        <left class="h-screen  pointer-events-none -z-50 p-4 w-[35vw] max-h-screen">
            <section class="bg-[#fafafb] rounded-xl h-full w-full grid  p-8">
                <logo class="w-max">
                    <img src="{{ asset('img/global/logo-dark.svg') }}" class="pb-12 h-[90px] ">
                </logo>
                <steps class="flex flex-col gap-8 -mt-8 ">
                    <step class="js-left-step done" data-step="-1">
                        <title_p class="font-semibold flex items-start gap-2">
                            <x-far-circle-check class="w-[18px] h-[18px] mt-[5px]"></x-far-circle-check>
                            <span class="h-[28px] mt-0.5 block">
                                Sign Wallet
                            </span>
                        </title_p>
                        <title_s class="block text-[#99a1aa] ml-[26px]">
                            Secure Your Identity with Auth
                        </title_s>
                    </step>
                    <step class="js-left-step wait" data-step="0">
                        <title_p class="font-semibold flex items-start gap-2">
                            <x-far-circle-check class="w-[18px] h-[18px] mt-[5px]"></x-far-circle-check>
                            <span class="h-[28px] mt-0.5 block">
                                identity information
                            </span>
                        </title_p>
                        <title_s class="block text-[#99a1aa] ml-[26px]">
                            Secure Your Identity with Auth
                        </title_s>
                    </step>
                    <step class="js-left-step wait" data-step="1">
                        <title_p class="font-semibold flex items-start gap-2">
                            <x-far-circle-check class="w-[18px] h-[18px] mt-[5px]"></x-far-circle-check>
                            <span class="h-[28px] mt-0.5 block">
                                Educational Information
                            </span>
                        </title_p>
                        <title_s class="block text-[#99a1aa] ml-[26px]">
                            Secure Your Identity with Auth
                        </title_s>
                    </step>
                    <step class="js-left-step wait" data-step="2">
                        <title_p class="font-semibold flex items-start gap-2">
                            <x-far-circle-check class="w-[18px] h-[18px] mt-[5px]"></x-far-circle-check>
                            <span class="h-[28px] mt-0.5 block">
                                Occupation and skills
                            </span>
                        </title_p>
                        <title_s class="block text-[#99a1aa] ml-[26px]">
                            Social network
                        </title_s>
                    </step>
                    <step class="js-left-step wait" data-step="3">
                        <title_p class="font-semibold flex items-start gap-2">
                            <x-far-circle-check class="w-[18px] h-[18px] mt-[5px]"></x-far-circle-check>
                            <span class="h-[28px] mt-0.5 block">
                                Social media
                            </span>
                        </title_p>
                        <title_s class="block text-[#99a1aa] ml-[26px]">
                            Your social media accounts
                        </title_s>
                    </step>
                    <step class="js-left-step wait" data-step="4">
                        <title_p class="font-semibold flex items-start gap-2">
                            <x-far-circle-check class="w-[18px] h-[18px] mt-[5px]"></x-far-circle-check>
                            <span class="h-[28px] mt-0.5 block">
                                Terms and conditions
                            </span>
                        </title_p>
                        <title_s class="block text-[#99a1aa] ml-[26px]">
                            Secure Your Identity with Auth
                        </title_s>
                    </step>
                    <step class="js-left-step wait" data-step="5">
                        <title_p class="font-semibold flex items-start gap-2">
                            <x-far-circle-check class="w-[18px] h-[18px] mt-[5px]"></x-far-circle-check>
                            <span class="h-[28px] mt-0.5 block">
                                Sign Wallet
                            </span>
                        </title_p>
                        <title_s class="block text-[#99a1aa] ml-[26px]">
                            Secure Your Identity with Auth
                        </title_s>
                    </step>
            </section>
        </left>
        <right class="flex flex-col justify-center items-center w-full h-screen relative">
            @if ($errors->any())
                <errors
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded absolute mx-auto w-[90%] z-50 top-10 right-0 left-0 "
                    role="alert">
                    <strong class="font-bold">Validation Error!</strong>
                    <ul class="mt-3 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <span onclick="document.querySelector('errors').style.display = 'none';"
                        class="absolute cursor-pointer top-0 bottom-0 right-0 px-4 py-3">
                        <x-fas-times></x-fas-times>
                    </span>
                </errors>
            @endif
            <form class="flex flex-col w-max gap-4" method="post" action="{{ route('walletconnect.update_user') }}">
                @csrf
                <heading class="flex flex-col items-center justify-center gap-2">
                    <secondary class="text-[#B5B5BE]">
                        GET STARTED</secondary>
                    <orginal class="font-semibold text-3xl text-center w-96">
                        Apply for Million Chance to Get Dreams Job</orginal>
                </heading>
                <page class="js-section-page w-[750px]" data-page="0">
                    <input type="hidden" name="birthday" class="js-real-birthday">

                    <fields class="flex flex-col gap-4 mt-4">
                        <fullname class="grid grid-cols-2 gap-4">
                            <firstname class="relative">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                        class="fa-regular fa-user text-[#92929d]"></i></icon>
                                <input
                                    class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                    placeholder="First name" name="first_name" value="{{ $user->first_name }}" />
                            </firstname>
                            <lastname class="relative">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                        class="fa-regular fa-user text-[#92929d]"></i></icon>
                                <input
                                    class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                    placeholder="Last Name" name="last_name" value="{{ $user->last_name }}" />
                            </lastname>
                        </fullname>
                        <email class="grid grid-cols-1 gap-4">
                            <column class="relative">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                        class="fa-regular fa-envelope text-[#92929d]"></i></icon>
                                <input
                                    class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                    placeholder="Your Email" name="email" value="{{ $user->email }}" />
                            </column>
                        </email>
                        <bithday class="grid grid-cols-4 gap-4">
                            <label class="relative  flex items-center"><span class=" text-[#B5B5BE] flex gap-4 px-2">
                                    <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                    <i class="fa-regular fa-cake-candles text-[#92929d]"></i>Birthday
                                </span>
                            </label>
                            <year class="relative">
                                <select
                                    class="js_select_year border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                </select>
                            </year>
                            <month class="relative">
                                <select
                                    class="js_select_month border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                </select>
                            </month>
                            <day class="relativ">
                                <select
                                    class="js_select_day border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                </select>
                            </day>
                        </bithday>
                        <nationality class="js-section-nationality grid grid-cols-4 gap-4">
                            <label class="relative  flex items-center">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                <span class=" text-[#B5B5BE] flex gap-4 px-2">
                                    <i class="fa-regular fa-file-certificate text-[#92929d]"></i>
                                </span>
                                <text class="text-[#B5B5BE] px-2">Nationality</text>
                            </label>
                            <country>
                                <select name="country_primary" value="{{ $user->{'country_primary'} }}"
                                    class="js-select-nationality-country border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                    <option value="0">Select Country</option>
                                </select>
                            </country>
                            <city>
                                <select name="state_primary" value="{{ $user->{'state_primary'} }}"
                                    class="js-select-nationality-state border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                    <option value="0">Select State</option>
                                </select>
                            </city>
                            <action>
                                <button type="button"
                                    class="js-btn-add-nationality flex items-center justify-center w-full h-full">
                                    <icon class="flex flex-grow w-full justify-center">
                                        <x-fas-plus class="text-[#92929d]"></x-fas-plus>
                                    </icon>
                                </button>
                            </action>
                        </nationality>
                        <nationality_sec class="js-section-nationality-secondray grid grid-cols-4 gap-4"
                            style="display: none">
                            <label class="relative  flex items-center">
                                <span class=" text-[#B5B5BE] flex gap-4 px-2">
                                    <icon class="flex flex-grow w-full justify-center">
                                        <x-fas-plus class="text-[#92929d]"></x-fas-plus>
                                    </icon>
                                </span>
                                <text class="text-[#B5B5BE]">Nationality</text>
                            </label>
                            <country>
                                <select name="country_secondary" value="{{ $user->{'country_secondary'} }}"
                                    class="js-select-nationality-country_secondary border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                    <option value="0">Select Country</option>
                                </select>
                            </country>
                            <city>
                                <select name="state_secondary" value="{{ $user->{'state_secondary'} }}"
                                    class="js-select-nationality-state_secondary border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                    <option value="0">Select State</option>
                                </select>
                            </city>
                            <action>
                                <button type="button"
                                    class="js-btn-remove-nationality flex items-center justify-center w-full h-full">
                                    <icon class="flex flex-grow w-full justify-center">
                                        <x-fas-minus class="text-[#92929d]"></x-fas-minus>
                                    </icon>
                                </button>
                            </action>
                        </nationality_sec>
                        <gender class="grid grid-cols-4 gap-4">
                            <label class="relative  flex items-center"><span class=" text-[#B5B5BE] flex gap-4 px-2">
                                    <reqire class="absolute left-2 top-2 text-error">*</reqire>

                                    <i class="fa-regular fa-venus-mars text-[#92929d]"></i>Gender
                                </span>
                            </label>
                            <female class="relative">
                                <label
                                    class="flex items-center gap-2 cursor-pointer w-full justify-center border-b-2 px-4 py-4 border-[#E2E2EA]  "><span
                                        class="block text-sm">Female</span>
                                    <form__fields__row__col__input>
                                        <input
                                            class="border-[#E2E2EA]   h-max bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 flex items-center px-0"
                                            type="radio" name="gender" value="female" />
                                    </form__fields__row__col__input>
                                </label>
                            </female>
                            <male class="relative">
                                <label
                                    class="flex items-center gap-2 cursor-pointer w-full justify-center border-b-2 px-4 py-4 border-[#E2E2EA]  "><span
                                        class="block text-sm">Male</span>
                                    <form__fields__row__col__input>
                                        <input
                                            class="border-[#E2E2EA]   h-max bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 flex items-center px-0"
                                            type="radio" name="gender" value="male" />
                                    </form__fields__row__col__input>
                                </label>
                            </male>
                            <other class="relative">
                                <label
                                    class="flex items-center gap-2 cursor-pointer  w-full justify-center border-b-2 px-4 py-4 border-[#E2E2EA]  "><span
                                        class="block text-sm">Other</span>
                                    <form__fields__row__col__input>
                                        <input
                                            class="border-[#E2E2EA]   h-max bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 flex items-center px-0"
                                            type="radio" name="gender" value="other" />
                                    </form__fields__row__col__input>
                                </label>
                            </other>
                        </gender>
                    </fields>
                    <trms class="mt-4  text-center text-sm w-full block text-[#92929D]">
                        The terms and conditions will be shown in the last step.</trms>
                </page>
                <page class="js-section-page w-[750px]" data-page="1">
                    <education data-section='0' class="js-section-education flex flex-col gap-4 mt-4">
                        <collage class="grid grid-cols-5 gap-4">
                            <country class="relative col-span-2">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                        class="fa-regular fa-user text-[#92929d]"></i></icon>
                                <select data-section='0' id="id-select-uni-country"
                                    class="js-select-uni-country  border-[#E2E2EA] w-full text-black  placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 bg-transparent flex items-center px-10"
                                    placeholder="Field of study" name="edu_country[]" />
                                <option value="0">
                                    Country</option>
                                </select>
                            </country>
                            <univercity class="relative col-span-2">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                <icon class="absolute  block h-max left-2 top-0 bottom-0 my-auto"><i
                                        class="fa-regular fa-user text-[#92929d]"></i></icon>
                                <select data-section='0'
                                    class="js-select-uni border-[#E2E2EA] w-full text-black  placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                    placeholder="Univercity / Collage " name="edu_univercity[]" />
                                <option value="0">
                                    Univercity / Collage
                                </option>
                                </select>
                            </univercity>
                            <action>
                                <button type="button"
                                    class="js-add-education gap-2 text-neutral/80 flex items-center pl-2  w-full h-full">
                                    <i class="fa-solid fa-plus "></i>
                                    <span>More</span>
                                </button>
                                <button type="button" style="display: none"
                                    class="js-remove-education gap-2 text-neutral/80 flex items-center pl-2 w-full h-full">
                                    <i class="fa-solid fa-minus "></i>
                                    <span>Remove</span>
                                </button>
                            </action>
                        </collage>
                        <degree class="grid grid-cols-2 gap-4">
                            <field class="relative">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto">
                                    <i class="fa-regular fa-user text-[#92929d]"></i>
                                </icon>
                                <input
                                    class="border-[#E2E2EA] w-full text-neutral/80 bg-transparent  placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                    placeholder="Field of Study" name="edu_field[]" />
                            </field>
                            <type class="relative">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                        class="fa-regular fa-user text-[#92929d]"></i></icon>
                                <input
                                    class="border-[#E2E2EA] w-full text-neutral/80 bg-transparent  placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                    placeholder="Degree " name="edu_degree[]" />
                            </type>
                        </degree>
                    </education>
                </page>
                <page class="js-section-page w-[950px]" data-page='2'>
                    <grid class="grid grid-cols-10 w-full mt-8">
                        <job class="col-span-4 w-[80%] flex flex-col gap-8">
                            <heading class="text-xl my-2">Job information</heading>
                            <profession data-section='0' class="js-section-profession grid grid-cols-5 gap-4">
                                <column class="relative col-span-4">
                                    <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                    <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                            class="fa-regular fa-user-doctor text-[#92929d]"></i></icon>
                                    <input
                                        class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                        placeholder="Profession" name="profession[]" />
                                </column>
                                <column>
                                    <button type="button"
                                        class="js-btn-profession border-[#E2E2EA]  rounded  text-neutral gap-2 flex items-center justify-center w-max mx-auto px-4 h-full ">
                                        More
                                        <x-fas-plus />
                                    </button>
                                    <button style="display: none" type="button"
                                        class="js-btn-profession-remove border-[#E2E2EA]  rounded  text-neutral gap-2 flex items-center justify-center w-max mx-auto px-4 h-full ">
                                        Delete
                                        <x-fas-minus />
                                    </button>
                                </column>
                            </profession>
                            <skill data-section='0' class="js-section-skill grid grid-cols-5 gap-4">
                                <column class="relative col-span-4">
                                    <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                    <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                            class="fa-regular  fa-graduation-cap text-[#92929d]"></i></icon>
                                    <input
                                        class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                        placeholder="Skill" name="skill[]" />
                                </column>
                                <column>
                                    <button type="button"
                                        class="js-btn-skill border-[#E2E2EA]  rounded  text-neutral gap-2 flex items-center justify-center w-max mx-auto px-4 h-full ">
                                        More
                                        <x-fas-plus />
                                    </button>
                                    <button style="display: none" type="button"
                                        class="js-btn-skill-remove border-[#E2E2EA]  rounded  text-neutral gap-2 flex items-center justify-center w-max mx-auto px-4 h-full ">
                                        Delete
                                        <x-fas-minus />
                                    </button>
                                </column>
                            </skill>
                            <language data-section='0' class="js-section-language grid grid-cols-5 gap-4">
                                <column class="relative col-span-4">
                                    <reqire class="absolute left-2 top-2 text-error">*</reqire>
                                    <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                            class="fa-regular  fa-earth-americas text-[#92929d]"></i></icon>
                                    <select
                                        class="js-select-language border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                        placeholder="language" name="language[]" />
                                    <option value="0">language</option>
                                    </select>
                                </column>
                                <column>
                                    <button type="button"
                                        class="js-btn-language border-[#E2E2EA]  rounded  text-neutral gap-2 flex items-center justify-center w-max mx-auto px-4 h-full ">
                                        More
                                        <x-fas-plus />
                                    </button>
                                    <button style="display: none" type="button"
                                        class="js-btn-language-remove border-[#E2E2EA]  rounded  text-neutral gap-2 flex items-center justify-center w-max mx-auto px-4 h-full ">
                                        Delete
                                        <x-fas-minus />
                                    </button>
                                </column>
                            </language>
                        </job>
                        <cv class="col-span-6 gap-2 flex flex-col">
                            <heading class="text-xl my-2">About you</heading>
                            <textarea name="cv" class="js-cv w-full h-64 bg-white border rounded border-neutral/50 p-4">{{ $user->cv }}</textarea>
                        </cv>
                    </grid>
                </page>
                <page class="js-section-page " data-page='3'>
                    <socialmedia class="grid grid-cols-5 ">
                        <heading class="col-span-5 text-xl my-4 text-center">Social Media Links</heading>
                        <website_label class="flex items-center h-full w-full  col-span-1">Website</website_label>
                        <website class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-regular fa-globe text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your website URL" name="website" value="{{ $user->website }}" />
                        </website>
                        <facebook_label class="flex items-center h-full w-full  col-span-1">Facebook</facebook_label>
                        <facebook class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-facebook-f text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your Facebook username" name="facebook"
                                value="{{ $user->facebook }}" />
                        </facebook>
                        <twitter_label class="flex items-center h-full w-full  col-span-1">Twitter</twitter_label>
                        <twitter class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-twitter text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your Twitter username" name="twitter"
                                value="{{ $user->twitter }}" />
                        </twitter>
                        <instagram_label class="flex items-center h-full w-full col-span-1">Instagram</instagram_label>
                        <instagram class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-instagram text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your Instagram username" name="instagram"
                                value="{{ $user->instagram }}" />
                        </instagram>
                        <linkedin_label class="flex items-center h-full w-full col-span-1">LinkedIn</linkedin_label>
                        <linkedin class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-linkedin-in text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your LinkedIn username" name="linkedin"
                                value="{{ $user->linkedin }}" />
                        </linkedin>
                        <youtube_label class="flex items-center h-full w-full col-span-1">YouTube</youtube_label>
                        <youtube class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-youtube text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your YouTube channel URL" name="youtube"
                                value="{{ $user->youtube }}" />
                        </youtube>
                        <telegram_label class="flex items-center h-full w-full col-span-1">Telegram</telegram_label>
                        <telegram class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-telegram-plane text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your Telegram username" name="telegram"
                                value="{{ $user->telegram }}" />
                        </telegram>
                    </socialmedia>
                </page>
                <page class="js-section-page w-[750px] " data-page='4'>
                    <terms class="flex flex-col gap-2 py-8 text-center">
                        <heading>
                            <h1 class="text-2xl font-semibold">Terms and Conditions</h1>
                        </heading>
                        <content>
                            The user agrees to comply with all applicable laws and regulations while using the site.
                            The user must be at least 13 years of age or have parental consent to use the site.
                            The user agrees not to post any content that is harmful, offensive, or infringes on the
                            rights of
                            others.
                            The site reserves the right to remove any content that violates its policies or is deemed
                            inappropriate.
                            The user agrees not to use the site for spamming, phishing, or other malicious activities.
                            The user is responsible for maintaining the security of their account and password.
                            The site is not responsible for any loss or damage resulting from the use of the site.
                            The user agrees to indemnify and hold harmless the site and its owners from any claims
                            arising out
                            of their use of the site.
                            The site may suspend or terminate a user's account for any violation of these terms.
                            The user agrees to the site's privacy policy and acknowledges that their personal
                            information may be
                            collected and used for various purposes.
                        </content>
                    </terms>
                </page>
                <buttons class="flex gap-4 -mt-8">
                    <button type="button"
                        class="js-btn-prev h-12 mt-12 border-[#5956E9] text-[#5956E9] cursor-pointer  border rounded-[10px] flex items-center justify-center w-full">
                        <span class="block text-sm font-semibold">Back</span>
                    </button>
                    <button type="button"
                        class="js-btn-next opacity-50   cursor-not-allowed h-12 mt-12 bg-[#5956E9] text-white rounded-[10px] flex items-center justify-center w-full">
                        <span class="block text-sm font-semibold">Next step</span>
                    </button>
                    <button type="submit"
                        class="js-btn-submit h-12 mt-12 bg-[#5956E9] cursor-pointer text-white rounded-[10px] flex items-center justify-center w-full">
                        <span class="block text-sm font-semibold">submit</span>
                    </button>
                </buttons>
            </form>
        </right>
    </main>


</x-layout.auth>
