<x-layout.auth>
    @vite('resources/js/auth-register-corp.js')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite('resources/css/filepond.scss')
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }

        select,
        option {
            background: #710e0e00 !important;
            border: 1px solid #710e0e00 !important;
        }

        .js-left-step.active i {
            color: #5956e9;
        }

        .js-left-step.done i {
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
                            <i class="fa-regular fa-circle-check    w-[18px] h-[18px] text-lg"></i>
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
                            <i class="fa-regular fa-circle-check    w-[18px] h-[18px] text-lg"></i>
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
                            <i class="fa-regular fa-circle-check    w-[18px] h-[18px] text-lg"></i>
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
                            <i class="fa-regular fa-circle-check    w-[18px] h-[18px] text-lg"></i>
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
                            <i class="fa-regular fa-circle-check  w-[18px] h-[18px] text-lg"></i>
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
                            <i class="fa-regular fa-circle-check  w-[18px] h-[18px] text-lg"></i>
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
                            <i class="fa-regular fa-circle-check    w-[18px] h-[18px] text-lg"></i>
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
                        <i class="fas fa-times"></i>
                    </span>
                </errors>
            @endif


            <form class="flex flex-col w-max gap-4" method="post" action="{{ route('walletconnect.register_corp') }}">
                @csrf
                <input type="hidden" name="user_type" value="corporation">
                <heading class="flex flex-col items-center justify-center gap-2">
                    <secondary class="text-[#B5B5BE]">
                    GET STARTED</secondary>
                    <orginal class="font-semibold text-3xl text-center w-96">
                    Empower Your Digital Identity</orginal>
                </heading>
                <page class="js-section-page w-[750px]" data-page="0">
                    <input type="hidden" name="inviter_email" value="">
                    <input type="hidden" name="is_fee_paid">
                    <script>
                        document.querySelector('[name="inviter_email"]').value = localStorage.getItem('js_inviter_email')
                        document.querySelector('[name="is_fee_paid"]').value = localStorage.getItem('js_is_fee_paid')
                    </script>
                    <type class="flex gap-2 mx-auto w-max">
                        <label class="font-inter font-semibold">Account type : </label>
                        <span>Invidual</span>
                        <a href="{{ route('walletconnect.showRegistrationForm', ['wallet_address' => $wallet_address]) }}"
                            class="rounded-full h-5 cursor-pointer w-10 bg-neutral/20 relative">
                            <circle class="rounded-full float-right bg-primary w-5 h-5 block"></circle>
                        </a>
                        <span>Goverment / Corporation</span>
                    </type>

                    <fields class="flex flex-col gap-4 mt-4">

                        <row class="grid grid-cols-2 gap-4">
                            <name class="relative">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>

                                <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                        class="fa-regular fa-user text-[#92929d]"></i></icon>
                                <input
                                    class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                    placeholder="Coporation name" name="corp_name" value="{{ old('name') }}" />
                            </name>

                            <email class="grid grid-cols-1 gap-4">
                                <column class="relative">
                                    <reqire class="absolute left-2 top-2 text-error">*</reqire>

                                    <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                            class="fa-regular fa-envelope text-[#92929d]"></i></icon>

                                    <input
                                        class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                        placeholder="Work mail" name="email" value="{{ old('email') }}" />
                                </column>
                            </email>
                        </row>
                        <category class="js-corp-cat-row grid  gap-4 grid-cols-4">
                            <label class="relative  flex items-center"><span class=" text-[#B5B5BE] flex gap-4 px-2">
                                    <reqire class="absolute left-2 top-2 text-error">*</reqire>

                                    <i class="fa-regular fa-rectangle-list text-[#92929d]"></i>Category
                                </span>
                            </label>
                            <select name="corp_cat_pri"
                                class="js-corp-cat-pri
                                 border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                            </select>
                            <select name="corp_cat_sec"
                                class="js-corp-cat-sec border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                <option value="0">Select subset</option>
                            </select>
                        </category>
                        <establishment class="grid grid-cols-4 gap-4">
                            <input type="hidden" class="js-real-establishment" name="corp_establishment">
                            <label class="relative  flex items-center"><span class=" text-[#B5B5BE] flex gap-4 px-2">
                                    <reqire class="absolute left-2 top-2 text-error">*</reqire>

                                    <i class="fa-regular fa-cake-candles text-[#92929d]"></i>Establishment
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
                        </establishment>
                        <nationality class="js-section-nationality grid grid-cols-4 gap-4">

                            <label class="relative  flex items-center">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>

                                <span class=" text-[#B5B5BE] flex gap-4 px-3">
                                    <i class="fa-regular fa-file-certificate text-[#92929d]"></i>
                                </span>
                                <text class="text-[#B5B5BE]">Nationality</text>
                            </label>
                            <country>
                                <select name="corp_country_pri" value="{{ old('country - primary') }}"
                                    class="js-select-nationality-country border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                    <option value="0">Select Country</option>
                                </select>
                            </country>
                            <city>
                                <select name="corp_state_pri" value="{{ old('state - primary') }}"
                                    class="js-select-nationality-state border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                    <option value="0">Select State</option>
                                </select>
                            </city>
                            <action>
                                <button type="button"
                                    class="js-btn-add-nationality  flex  items-center justify-center w-full h-full">
                                    <icon class="flex flex-grow w-full justify-center">
                                        <x-fas-plus class="text-[#92929d]"></x-fas-plus>
                                    </icon>
                                </button>
                            </action>
                        </nationality>
                        <nationality_sec class="js-section-nationality-secondray grid grid-cols-4 gap-4"
                            style="display: none">
                            <label class="relative  flex items-center">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>

                                <span class=" text-[#B5B5BE] flex gap-4 px-2">
                                    <i class="fa-regular fa-file-certificate text-[#92929d]"></i>
                                </span>
                                <text class="text-[#B5B5BE]">Nationality</text>
                            </label>
                            <country>
                                <select name="corp_country_sec" value="{{ old('country - secondary') }}"
                                    class="js-select-nationality-country_secondary border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                    <option value="0">Select Country</option>

                                </select>
                            </country>
                            <city>
                                <select name="corp_state_sec" value="{{ old('state - secondary') }}"
                                    class="js-select-nationality-state_secondary border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                                    <option value="0">Select State</option>

                                </select>
                            </city>
                            <action>
                                <button type="button"
                                    class="js-btn-remove-nationality flex items-center justify-center w-full h-full">
                                    <x-fas-minus class="text-[#92929d]"></x-fas-minus>
                                </button>
                            </action>
                        </nationality_sec>

                        <gender class="grid grid-cols-4 gap-4">
                            <label class="relative  flex items-center"><span class=" text-[#B5B5BE] flex gap-4 px-2">
                                    <reqire class="absolute left-2 top-2 text-error">*</reqire>

                                    <i class="fa-regular fa-buildings text-[#92929d]"></i>Type
                                </span>
                            </label>
                            <corporation class="relative">
                                <label
                                    class="flex items-center gap-2 cursor-pointer  w-full justify-center border-b-2 px-4 py-4 border-[#E2E2EA]  "><span
                                        class="block text-sm">Corporation</span>
                                    <form__fields__row__col__input>
                                        <input
                                            class="border-[#E2E2EA]   h-max bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 flex items-center px-0"
                                            type="radio" name="corp_type" value="corporation" />
                                    </form__fields__row__col__input>
                                </label>
                            </corporation>
                            <goverment class="relative">
                                <label
                                    class="flex items-center gap-2 cursor-pointer w-full justify-center border-b-2 px-4 py-4 border-[#E2E2EA]  "><span
                                        class="block text-sm">Goverment</span>
                                    <form__fields__row__col__input>
                                        <input
                                            class="border-[#E2E2EA]   h-max bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 flex items-center px-0"
                                            type="radio" name="corp_type" value="goverment" />
                                    </form__fields__row__col__input>
                                </label>
                            </goverment>
                            <other class="relative">
                                <label
                                    class="flex items-center gap-2 cursor-pointer  w-full justify-center border-b-2 px-4 py-4 border-[#E2E2EA]  "><span
                                        class="block text-sm">Small Bussiness</span>
                                    <form__fields__row__col__input>
                                        <input
                                            class="border-[#E2E2EA] h-max bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 flex items-center px-0"
                                            type="radio" name="corp_type" value="Small" />
                                    </form__fields__row__col__input>
                                </label>
                            </other>
                        </gender>
                        <wallet class="grid grid-cols-1 gap-4">
                            <column class="relative">
                                <reqire class="absolute left-2 top-2 text-error">*</reqire>

                                <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                        class="fa-regular fa-wallet text-[#92929d]"></i></icon>

                                <input readonly
                                    class="js-input-wallet-address border-[#E2E2EA] w-full text-neutral/80  placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                    placeholder="Wallet address" name="wallet" value="{{ old('wallet') }}" />

                                <wrong
                                    class="absolute right-0 top-2 bottom-0 text-primary cursor-pointer js-btn-not-you ">
                                    not
                                    you? </wrong>
                            </column>
                        </wallet>
                    </fields>

                    <trms class="mt-4  text-center text-sm w-full block text-[#92929D]">
                        The terms and conditions will be shown in the last step.</trms>

                </page>
                <page class="js-section-page w-[750px]" data-page="1">
                    <type class="flex hidden gap-2 mx-auto w-max">
                        <label class="font-inter font-semibold"> Form : </label>
                        <span>Classic</span>
                        <input type="hidden" class="js-corp_form_real" value="classic" name="corp_form"
                            id="">
                        <button data-active-tab="dao" type="button"
                            class="js-corp-tab-change rounded-full h-5 cursor-pointer w-10 bg-neutral/20 relative">
                            <circle class="js-corp-tab-circle rounded-full float-left bg-primary w-5 h-5 block">
                            </circle>
                        </button>
                        <span>Decentral (DAO)</span>
                    </type>
                    <tab data-tab="classic" class="js-corp-tab flex flex-col gap-4">
                        <heading class="block mt-4 font-semibold">Corporation documention : </heading>
                        <p>You can add PDF,Image file and write text</p>

                        <input type="file" class="filepond" value="0">
                        <input type="hidden" name="corp_file" class="js-corp-file" value="0">
                        <textarea name="corp_cv " class="border border-neutral-5/30 p-5 rounded-xl"
                            placeholder="Write about your document information"></textarea>
                        {{-- <label class="relative grow w-1/2  flex items-center "><span
                                class=" text-[#B5B5BE] flex gap-4 px-2">
                                <i class="fa-regular fa-globe text-[#92929d]"></i>DAO Dashboard link </span>
                        </label> --}}
                        <input value="" placeholder="Enter your dao id Ex : 0x123..."
                            class="js-dao-link
                     border-[#E2E2EA] bg-white w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-0">
                    </tab>
                    <tab data-tab="dao" class="js-corp-tab flex gap-4 items-center" style="display:none">

                    </tab>
                </page>

                <page class="js-section-page " data-page='2'>
                    <socialmedia class="grid grid-cols-5 ">
                        <heading class="col-span-5 text-xl my-4 text-center">Social Media Links</heading>
                        <website_label class="flex items-center h-full w-full  col-span-1">Website</website_label>
                        <website class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-regular fa-globe text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your website URL" name="website" value="{{ old('website') }}" />
                        </website>
                        <facebook_label class="flex items-center h-full w-full  col-span-1">Facebook</facebook_label>
                        <facebook class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-facebook-f text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your Facebook username" name="facebook"
                                value="{{ old('facebook') }}" />
                        </facebook>
                        <twitter_label class="flex items-center h-full w-full  col-span-1">Twitter</twitter_label>
                        <twitter class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-twitter text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your Twitter username" name="twitter"
                                value="{{ old('twitter') }}" />
                        </twitter>
                        <instagram_label class="flex items-center h-full w-full col-span-1">Instagram</instagram_label>
                        <instagram class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-instagram text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your Instagram username" name="instagram"
                                value="{{ old('instagram') }}" />
                        </instagram>
                        <linkedin_label class="flex items-center h-full w-full col-span-1">LinkedIn</linkedin_label>
                        <linkedin class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-linkedin-in text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your LinkedIn username" name="linkedin"
                                value="{{ old('linkedin') }}" />
                        </linkedin>
                        <youtube_label class="flex items-center h-full w-full col-span-1">YouTube</youtube_label>
                        <youtube class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-youtube text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your YouTube channel URL" name="youtube"
                                value="{{ old('youtube') }}" />
                        </youtube>
                        <telegram_label class="flex items-center h-full w-full col-span-1">Telegram</telegram_label>
                        <telegram class="relative col-span-4">
                            <icon class="absolute block h-max left-2 top-0 bottom-0 my-auto"><i
                                    class="fa-brands fa-telegram-plane text-[#92929d]"></i></icon>
                            <input
                                class="border-[#E2E2EA] w-full placeholder:text-[#B5B5BE] border-l-none border-r-none border-t-none border-b-2 h-12 flex items-center px-10"
                                placeholder="Enter your Telegram username" name="telegram"
                                value="{{ old('telegram') }}" />
                        </telegram>

                    </socialmedia>
                </page>
                <page class="js-section-page w-[750px] " data-page='3'>
                    <terms class="flex flex-col gap-2 py-8 text-center">
                        <heading>
                            <h1 class="text-2xl font-semibold">Terms and Conditions</h1>
                        </heading>
                        <content>
                        Users are granted limited, revocable access to the platform and its content. When registering, users commit to providing accurate, current information and maintaining the confidentiality of their account details. Users may create, upload, or share content on Bnic.io, retaining ownership of their content. However, by doing so, they grant Bnic.io permission to utilize this content. Content considered inappropriate or against these terms can be modified or removed by Bnic.io. Transactions made on the blockchain through the platform are irreversible, so users should understand their implications. Bnic.io offers the platform "as is" without any guarantees and isn't responsible for losses or damages from using the site. Access to Bnic.io can be terminated or suspended for any user without prior notice. Terms may change, and users are encouraged to review them periodically. 
                        </content>
                    </terms>
                </page>
                <buttons class="flex gap-4 -mt-8">
                    <button type="button"
                        class="js-btn-prev h-12 mt-12 border-[#5956E9] text-[#5956E9] cursor-pointer  border rounded-[10px] flex items-center justify-center w-full">
                        <span class="block text-sm font-semibold">Back</span>
                    </button>
                    <button type="button"
                        class="js-btn-next opacity-50  cursor-not-allowed h-12 mt-12 bg-[#5956E9]  text-white rounded-[10px] flex items-center justify-center w-full">
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
