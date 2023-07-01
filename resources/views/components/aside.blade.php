@vite(['resources/css/x-aside.scss', 'resources/js/x-aside.js'])
@php
    $auth_user = Auth::user();
    $activeClass = 'bg-gradient-to-l text-white from-[#323337] to-[rgba(70,79,111,0.3)] shadow-[inset_0px_0.0625rem_0_rgba(255,255,255,0.05),0_0.25rem_0.5rem_0_rgba(0,0,0,0.1)]';
@endphp

<padding_bug class="block shrink-0"></padding_bug>
<xaside class="fixed p-4">
    <inside class="  w-full h-full rounded-xl flex flex-col gap-10  js-xaside-inside">
        <header class="h-[40px]">
            <a href="{{ route('dashboard.index') }}" class="x-aside-logo pl-3  -mr-10 flex text-white items-center gap-4">
                <img src="{{ asset('img/global/logo.svg') }}" class="js-xaside-logo w-max h-[40px]">
            </a>
            <action>
                <img src="{{ asset('icon/menu-arrow.svg') }}" alt="">
            </action>
            <button type="button" class="w-max rotate-180 hidden js-xaside-maximize-menu ">
                <img src="{{ asset('icon/menu-arrow.svg') }}" class="w-max ml-[15px]">
            </button>
        </header>
        <links class="x-aside-links z-50">

            {{-- home --}}
            <tooltip class="tooltip-right z-50" data-tip="Home">
                <a href="{{ route('dashboard.index') }}" class="x-aside-link-inside {{ Route::currentRouteName() == 'dashboard.index' ? $activeClass : '' }}">
                    <icon>
                        <x-fas-home class="text-primary " />
                    </icon>
                    <span class="xjs-main-aside-span">Home</span>
                </a>
            </tooltip>
            {{-- cert --}}
            <tooltip class="tooltip-right z-50" data-tip="Certificates">
                <a href="{{ route('category.index') }} " class="x-aside-link-inside {{ Route::currentRouteName() == 'category.index' ? $activeClass : '' }}">
                    <icon>
                        <x-fas-list-ul class="text-secondary" />
                    </icon>
                    <span class="xjs-main-aside-span">
                        Certificates
                    </span>
                </a>
            </tooltip>
            {{-- inbox --}}
            <tooltip class="tooltip-right z-50" data-tip="Inbox">
                <a href="{{ route('dashboard.inbox') }}" class="x-aside-link-inside {{ Route::currentRouteName() == 'dashboard.inbox' ? $activeClass : '' }}">
                    <icon>
                        <x-fas-inbox class="text-accent-2" />
                    </icon>
                    <span class="xjs-main-aside-span">
                        Inbox
                    </span>
                </a>
            </tooltip>
            {{-- events --}}
            <tooltip class="tooltip-right z-50" data-tip="Events">
                <a href="{{ route('event.index') }}" class="x-aside-link-inside  {{ Route::currentRouteName() == 'event.index' ? $activeClass : '' }}">
                    <icon>
                        <x-fas-calendar-day class="text-accent-4" />
                    </icon>
                    <span class="xjs-main-aside-span">
                        Events
                    </span>
                </a>
            </tooltip>
            {{-- votes --}}
            <tooltip class="tooltip-right z-50" data-tip="Events">
                <a href="{{ route('ballots.index') }}" class="x-aside-link-inside  {{ Route::currentRouteName() == 'ballots.index' ? $activeClass : '' }}">
                    <icon>
                        <x-fas-box class="text-accent-6" />
                    </icon>
                    <span class="xjs-main-aside-span">
                        Voting
                    </span>
                </a>
            </tooltip>
            {{-- petition --}}
            <tooltip class="tooltip-right z-50" data-tip="Events">
                <a href="{{ route('petitions.index') }}" class="x-aside-link-inside  {{ Route::currentRouteName() == 'petitions.index' ? $activeClass : '' }}">
                    <icon>
                        <x-fas-check-to-slot class="text-accent-7" />
                    </icon>
                    <span class="xjs-main-aside-span">
                        Petitions
                    </span>
                </a>
            </tooltip>
            {{-- setting --}}
            <tooltip class="tooltip-right z-50" data-tip="Settings">
                <a href="{{ route('walletconnect.edit') }}" class="x-aside-link-inside  {{ Route::currentRouteName() == 'walletconnect.edit' ? $activeClass : '' }}">
                    <icon>
                        <x-fas-cog class="text-accent-5" />
                    </icon>
                    <span class="xjs-main-aside-span">
                        Settings
                    </span>
                </a>
            </tooltip>
            {{-- logout --}}
            <a class="x-aside-link-inside cursor-pointer js-xaside-logout">
                <icon>
                    <x-fas-right-from-bracket class="text-accent-1" />
                </icon>
                <span class="xjs-main-aside-span">
                    Logout
                </span>
            </a>
            </tooltip>
        </links>
        <footer class="hidden absolute left-0 bottom-0 flex items-center justify-center capitalize w-full py-1 bg-[#0062ff] text-white">
            {{ $auth_user->user_type ?? 'public' }}
        </footer>
    </inside>

</xaside>
