<style>
    .css-core::-webkit-scrollbar {
        width: 0;
    }

    .css-nav::-webkit-scrollbar {
        width: 0;
    }
</style>
@php
    $url = request()->url();
    if (!isset($isowner)) {
        $isowner = true;
    }
    $columns = Schema::getColumnListing('users');
    $pub_count = 0;
    $pv_count = 0;
    foreach ($columns as $column) {
        if (Str::startsWith($column, 'i_pub_')) {
            if (Auth::user()->$column == 1) {
                $pub_count++;
            } else {
                $pv_count++;
            }
        }
    }
    
    function truncateString($str)
    {
        if (strlen($str) > 20) {
            return substr($str, 0, 15) . '..';
        } else {
            return $str;
        }
    }
@endphp


<x-layout.global>
    @vite(['resources/css/profile-index.scss', 'resources/js/nft.js', 'resources/js/dashboard-layout.js'])
    <input type="hidden" class="js-user_id" value="{{ $user->id }}">
    <input type="hidden" class="js-user_type" value="{{ $user->user_type }}">
    <dashboard>
        <alerts>
            @if ($errors->any())
                <div class="js-g-alert alert items-start alert-error fixed z-50 mx-auto w-[900px] right-0 left-0 bottom-32">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </span>
                    <close class="block cursor-pointer" onclick="document.querySelector('.js-g-alert').style.display = 'none'">
                        <x-fas-times></x-fas-times>
                    </close>
                </div>

            @endif

        </alerts>
        <modals>
            <x-layout.modals.publicity_edit :user="$user"></x-layout.modals.publicity_edit>
            <x-layout.modals.sign_wallet :user="$user"></x-layout.modals.sign_wallet>
            <x-layout.modals.trust_link :user="$user"></x-layout.modals.trust_link>
            <x-document_finder></x-document_finder> {{-- TODO --}}
            <x-layout.modals.edit_profile_picture :user="$user"></x-layout.modals.edit_profile_picture>
        </modals>
        <content>
            <main>

                <box class="bg-base-content py-[26px]  pr-[24px]  w-full fixed inset-0 flex z-20">

                    <input type="hidden" class="js_pvk" value="{{ config('app.pvk') }}">
                    <x-aside></x-aside>

                    <core class="css-core h-full  rounded-[1.25rem] max-h-full max-w-full w-full  overflow-y-scroll relative ">

                        <nav class="css-nav order-2  fixed right-[18px]  rounded-r-[1.25rem] top-[26px] h-[calc(100%-52px)] overflow-y-scroll  z-10 ">
                            <profile>
                                <div class="flex items-center gap-x-2">
                                    <relative class="relative">
                                        <img class="rounded-lg w-12 h-12 hover:outline outline-primary cursor-pointer js_profile_picture" src="{{ $user->profile_picture }}">
                                    </relative>
                                    <div>
                                        <heading class="text-lg flex gap-2 items-center justify-between  font-semibold text-base-content capitalize ">
                                            {{ $user->user_type == 'invidual' ? $user->first_name . ' ' . $user->last_name : $user->corp_name }}
                                            <badge class="badge badge-sm badge-primary capitalize">{{ $user->user_type }} </badge>
                                        </heading>

                                        <p class="text-sm text-neutral-5">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </profile>

                            @if (isset($user->profile_nft_id))
                                <widgect class="_qrcode">
                                    <header>
                                        Invidual explorer
                                    </header>

                                    <qrcode class=" rounded-lg shadow ">
                                        <a href="{{ route('dashboard.public_index', [$user->id]) }}">
                                            <img class="!w-[200px] rounded-lg !h-[200px] " src="{{ substr_replace($user->nfts->where('type', 'profile')->first()->url, 'png', -4) }}">
                                        </a>


                                    </qrcode>
                                    <wallet>
                                        <a href="https://mumbai.polygonscan.com/address/0x9bC71Cb4908c4171979d297328F471cb9939c959?a={{ $user->nfts->where('type', 'profile')->first()->token }}">
                                            <span>
                                                0x9bC71Cb4908c4171979d297328F471cb9939c959?a{{ $user->first()->token }}</a>
                                        </span>
                                        </a>
                                    </wallet>
                                </widgect>
                            @else
                                @if ($isowner && (isset($ispublic) && !$ispublic))
                                    <widgect class="_signchain">
                                        <headerx class="flex items-center pt-4 px-4 w-full justify-between">
                                            <span class="font-semibold  ">
                                                Enable your account

                                            </span>
                                            <input type="hidden" class="js_check_paid" value="{{ $user->is_fee_paid }}">
                                            @if ($user->is_fee_paid == 1)
                                                <badge data-tip="User : {{ $user->inviter_email }} paid your fee" class="js_tooltip bg-success px-4 py-1 rounded-full text-xs w-max"> Paid </badge>
                                            @endif
                                        </headerx>
                                        <message>
                                            Your account has not been activated yet and is in demo form. To enter the
                                            main
                                            network, you must register your information on the blockchain network.
                                        </message>
                                        <sign>
                                            <!-- Modal toggle -->
                                            <button class="js-btn-signchain btn mx-4 normal-case " type="button">Sign
                                                on
                                                blockchain</button>
                                        </sign>
                                    </widgect>
                                @else
                                    <widgect class="_signchain !items-center !justify-center !flex py-3">
                                        <span class="block">
                                            This Account is not verified
                                        </span>
                                    </widgect>
                                @endif
                            @endif

                            @if ($user->isAdmin == 1)
                                <widgect class="_invite">
                                    <header class="flex flex-col">
                                        <flex class="flex items-center w-full justify-between">
                                            <heading>Invitation</heading>
                                            <badge class="badge text-xs bg-accent-10/30 text-accent-10">Privilaged</badge>
                                        </flex>
                                        <small class="text-neutral-5">Send email as invitation</small>
                                    </header>
                                    <wbody class="px-4 flex gap-2 justify-between w-full">
                                        <label class="flex gap-2  items-center ">
                                            <small>Pay user verify fee?</small>
                                            <input type="checkbox" class="toggle toggle-sm js_pay_fee_toggle">
                                        </label>
                                        <flex class="flex order-12 gap-2">
                                            <label type="button" for="inviteModal" class="btn w-[80px] btn-sm  btn-neutral ml-auto">Select</label>
                                    </wbody>

                                    <input type="checkbox" id="inviteModal" class="modal-toggle" />
                                    <dialog id="inviteModal" class="modal bg-black/20">
                                        <div class="modal-box">
                                            <form method="POST" action="{{ route('mail.send_invite_mail') }}">
                                                @csrf
                                                <flex class="flex flex-col gap-4">
                                                    <h3 class="font-bold text-lg">Invitation Information</h3>
                                                    <grid class="grid grid-cols-2 gap-2">
                                                        <input type="hidden" readonly name="sender_email" value="{{ $user->email }}">
                                                        <input type="hidden" readonly name="sender_id" value="{{ $user->id }}">
                                                        <input type="hidden" readonly name="sender_full_name" value="{{ $user->user_type == 'invidual' ? $user->first_name . ' ' . $user->last_name : $user->corp_name }}">
                                                        <input type="text" name="reciver_first_name" placeholder="First name" class="input w-full border-neutral-5/30">
                                                        <input type="text" name="reciver_last_name" placeholder="Last name" class="input w-full border-neutral-5/30">
                                                        <input type="email"name="reciver_email" placeholder="example@domain.com" class="col-span-2 input w-full border-neutral-5/30">
                                                    </grid>
                                                    <flex class="flex items-center justify-between">
                                                        <label class="flex gap-2  items-center ">
                                                            <p>Pay user verify fee?</p>
                                                            <input type="checkbox" name="is_fee_paid" class="toggle js_pay_fee_toggle">
                                                        </label>
                                                        <button type="submit" class="btn w-[100px] btn-primary ml-auto">Send</button>
                                                    </flex>
                                                </flex>
                                            </form>
                                        </div>
                                        <label class="modal-backdrop" for="inviteModal">Close</label>
                                    </dialog>
                                </widgect>
                            @endif

                            @if ($isowner && (isset($ispublic) && !$ispublic) && $user->user_type != 'corporation')
                                <widgect class="_publicity relative">
                                    <header>
                                        <heading>Publicity Setting</heading>
                                    </header>
                                    <content class="px-4 flex flex-col">
                                        <box class="border-b w-full items-center justify-between flex py-2">
                                            <label>
                                                Public Cards
                                            </label>
                                            <badge class="badge badge-accent  flex min-w-[50px] px-2 justify-between items-center">
                                                <x-fas-eye class="h-3"></x-fas-eye>
                                                <span class="text-sm">
                                                    {{ $pub_count }}
                                                </span>
                                            </badge>
                                        </box>
                                        <box class="border-b w-full items-center justify-between flex py-2">
                                            <label>
                                                Private Cards
                                            </label>
                                            <badge class="badge bg-accent-2 text-white flex min-w-[50px] px-2 justify-between items-center">
                                                <x-fas-lock class="h-3"></x-fas-lock>
                                                <span class="text-sm">
                                                    {{ $pv_count }}
                                                </span>
                                            </badge>
                                        </box>
                                    </content>
                                    <footer class="px-4 mt-4 flex items-center justify-end gap-2">
                                        <a href="{{ route('dashboard.public_index', ['user_id' => $user->id]) }}" class="normal-case btn btn-sm w-[56px] flex bg-neutral-4">view</a>
                                        <button type="button" class="js_btn_open_publicity_modal w-[56px] normal-case btn btn-sm flex btn-neutral">Edit</button>
                                    </footer>
                                </widgect>
                            @endif


                            <widgect class="_trustlink relative">
                                <header class="flex justify-between items-center   flex-wrap">
                                    <heading>TrustLink</heading>

                                    @if (!$isowner)

                                        @if (auth()->user()->trusteds()->where('trusted_id', $user->id)->count() == 0)
                                            <trust>
                                                <a href="{{ route('api.trust_user', ['truster_id' => auth()->user()->id, 'trusted_id' => $user->id]) }}" class="btn btn-neutral capitalize btn-xs">Trust
                                                    {{ $user->user_type == 'invidual' ? truncateString($user->first_name) : truncateString($user->corp_name) }}
                                                </a>
                                            </trust>
                                        @else
                                            <trust>
                                                <trust>
                                                    <a href="{{ route('api.untrust_user', ['truster_id' => auth()->user()->id, 'trusted_id' => $user->id]) }}" class="btn btn-success capitalize btn-xs">UnTrust
                                                        {{ $user->user_type == 'invidual' ? truncateString($user->first_name) : truncateString($user->corp_name) }}
                                                    </a>
                                                </trust>
                                            </trust>
                                        @endif
                                    @endif
                                </header>
                                <content class="text-sm  px-4 flex flex-col ">
                                    <content class="flex flex-col">
                                        @if ($user->trusters()->count() != 0)
                                            <flex class="flex gap-1 items-center">

                                                <h1 class="text-5xl w-[30px]">{{ $user->trusters()->count() }}</h1>
                                                <div class="flex flex-col ">
                                                    <span>Users Trust this profile</span>
                                                    <a onclick="turst_link_modal.showModal()" class="link text-xs block link-primary link-hover">Check
                                                        {{ $user->first_name }} Trustlink </a>
                                                </div>
                                            </flex>
                                            <div class="p-[0.5px] bg-neutral-5/20 w-full my-2"></div>
                                            <flex class="flex gap-1 items-center">
                                                <h1 class="text-5xl w-[30px]">{{ $user->signcerts()->where('reciver_verify', 1)->where('creator_verify', 1)->count() }}</h1>
                                                <div class="flex flex-col ">
                                                    <span>Certificate verified</span>
                                                    <a class="text-xs text-neutral-5">It's only count verified certificates </a>
                                                </div>
                                            </flex>
                                        @else
                                            This user has no Trust network
                                        @endif
                                    </content>
                                </content>
                            </widgect>
                            <widgect class="_contact">

                                <header>
                                    Contact me
                                </header>
                                <socials>
                                    @foreach (['email', 'website', 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'telegram'] as $social)
                                        @if (isset($user->$social))
                                            <item>
                                                <icon>
                                                    @switch($social)
                                                        @case('email')
                                                            <x-fas-envelope class="text-primary" />
                                                        @break

                                                        @case('website')
                                                            <x-fas-globe class="text-secondary" />
                                                        @break

                                                        @case('facebook')
                                                            <x-fab-facebook class="text-accent-1" />
                                                        @break

                                                        @case('twitter')
                                                            <x-fab-twitter class="text-accent-2" />
                                                        @break

                                                        @case('instagram')
                                                            <x-fab-instagram class="text-accent-3" />
                                                        @break

                                                        @case('linkedin')
                                                            <x-fab-linkedin class="text-accent-4" />
                                                        @break

                                                        @case('youtube')
                                                            <x-fab-youtube class="text-pink-400" />
                                                        @break

                                                        @case('telegram')
                                                            <x-fab-telegram class="text-teal-600" />
                                                        @break
                                                    @endswitch
                                                </icon>
                                                <span>{{ $user->$social }}</span>
                                            </item>
                                        @endif
                                    @endforeach
                            </widgect>

                            <widgect class="_guidance hidden">
                                <header>
                                    Guidance
                                </header>
                                <style>
                                    ._color-default {
                                        background-color: white;
                                    }

                                    ._color-empty {
                                        background-color: #f3f3f4;
                                    }

                                    ._color-verified {
                                        background-color: #c6ffd0;
                                    }

                                    ._color-rejected {
                                        background-color: #ffd0d0;
                                    }
                                </style>
                                <value class="flex items-center gap-4 px-4">
                                    <item>
                                        <color class="_color-default"></color>
                                        <text>default</text>
                                    </item>
                                    <item>
                                        <color class="_color-empty"></color>
                                        <text>empty</text>
                                    </item>
                                    <item>
                                        <color class="_color-verified"></color>
                                        <text>verified</text>
                                    </item>
                                    <item>
                                        <color class="_color-rejected"></color>
                                        <text>rejected</text>
                                    </item>
                                </value>
                            </widgect>
                        </nav>
                        <root class="order-1 py-14 max-w-[1440px] mx-auto  pl-14 pr-[405px]">

                            <section class="_row_code">
                                <row class="grid grid-cols-1">



                                    <widgect class="_code">
                                        <flex class="flex items-center px-2">
                                            <icon class="bg-primary/20 rounded-xl items-center justify-center flex w-[60px] h-[60px]">
                                                <x-fas-barcode class="w-[30px] h-[30px] text-primary "></x-fas-barcode>
                                            </icon>
                                            <in>
                                                <header>
                                                    CODE
                                                </header>
                                                <value>
                                                    @if ($user->user_type == 'invidual')
                                                        {{ $user->gender[0] }}-{{ substr(hash('sha256', $user->email), 0, 8) }}-{{ $user->id }}
                                                    @else
                                                        {{ $user->corp_type[0] }}-{{ substr(hash('sha256', $user->email), 0, 8) }}-{{ $user->id }}
                                                    @endif
                                                </value>
                                            </in>
                                        </flex>
                                    </widgect>

                                </row>
                            </section>
                            {{ $slot }}
                            <padding class="block w-full pb-16"></padding>
                        </root>
                    </core>
                </box>
            </main>
        </content>
    </dashboard>


</x-layout.global>
