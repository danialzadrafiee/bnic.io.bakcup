
<x-layout.dashboard :user="$user" :ispublic="$isPublic" :isowner="$isOwner">
    @vite('resources/js/dashboard-index.js')
    @if ($user->user_type == 'invidual')
        @include('dashboard/content/invidual')
    @endif

    @if ($user->user_type == 'corporation')
        @include('dashboard/content/corporation')
    @endif

    <modals>
        @include('dashboard/modal/add_category')
    </modals>


    <templates class="hidden">
        <card class="js-card-template rounded shadow shadow-black/30 p-4  w-full flex flex-col gap-2">
            <header class="flex flex-col gap-1">
                <flex class="flex items-center justify-between">
                    <subject class="font-medium">
                        <ref class="js-card-subject"></ref>
                    </subject>
                </flex>
                <description class="text-sm">
                    <ref class="js-card-description"></ref>
                </description>

                <badges>
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium  px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 js-badge-creator">creator</span>
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium  px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 js-badge-reciver">reciver</span>
                </badges>
            </header>
            <picture>
                <img src="https://api.dicebear.com/6.x/initials/svg?seed=qgK4p36iXT" class="rounded">
            </picture>
            <flex class="flex items-center gap-4 text-neutral">
                <date class="text-sm flex gap-1 items-center">
                    <x-far-calendar />
                    <span class="mt-0.5">
                        <ref class="js-card-date"></ref>
                    </span>
                </date>
                <clock class="text-sm flex gap-1 items-center">
                    <x-far-clock />
                    <span class="mt-0.5">
                        <ref class="js-card-time"></ref>
                    </span>
                </clock>
            </flex>
            <metadata class="py-2 flex flex-col gap-1">
                <creator class="text-sm flex justify-between">
                    <icon class="flex items-center gap-1">
                        <x-fas-right-from-bracket />
                        <span>Creator: </span>
                    </icon>
                    <value>
                        <span>
                            <ref class="js-card-creator"></ref>
                        </span>
                    </value>
                </creator>
                <requester class="text-sm flex justify-between">
                    <icon class="flex items-center gap-1">
                        <x-fas-user />
                        <span>Requester: </span>
                    </icon>
                    <value>
                        <span>
                            <ref class="js-card-requester"></ref>
                        </span>
                    </value>
                </requester>

                <reciver class="text-sm flex justify-between">
                    <icon class="flex items-center gap-1">
                        <x-fas-eye />
                        <span>Reciver: </span>
                    </icon>
                    <value>
                        <span>
                            <ref class="js-card-reciver"></ref>
                        </span>
                    </value>
                </reciver>

            </metadata>
            <action>
                <a href="#" class="js-card-action bg-primary/80  hover:bg-primary text-white w-full py-2 text-sm block rounded text-center ">Watch
                    certificate</a>
            </action>
        </card>
    </templates>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <style>
        :root {
            --lemon-chiffon: #fbf8ccff;
            --champagne-pink: #fde4cfff;
            --tea-rose-red: #ffcfd2ff;
            --pink-lavender: #f1c0e8ff;
            --mauve: #cfbaf0ff;
            --jordy-blue: #a3c4f3ff;
            --non-photo-blue: #90dbf4ff;
            --electric-blue: #8eecf5ff;
            --aquamarine: #98f5e1ff;
            --celadon: #b9fbc0ff;
            --thistle: #d8bfd8ff;
            --powder-blue: #b0e0e6ff;
            --peach-puff: #ffdab9ff;
            --honeydew: #f0fff0ff;
            --misty-rose: #ffe4e1ff;
            --light-sky-blue: #87ceebff;
            --light-salmon: #ffa07aff;
            --cornsilk: #fff8dcff;
            --lavender-blush: #fff0f5ff;
            --linen: #faf0e6ff;

            --lemon-chiffon-dark: #7f7c66ff;
            --champagne-pink-dark: #7f6a67ff;
            --tea-rose-red-dark: #7f6667ff;
            --pink-lavender-dark: #78607c;
            --mauve-dark: #675f78;
            --jordy-blue-dark: #52707d;
            --non-photo-blue-dark: #48757c;
            --electric-blue-dark: #44757b;
            --aquamarine-dark: #4b7d70;
            --celadon-dark: #5c7d60;
            --thistle-dark: #6c5e6c;
            --powder-blue-dark: #58706e;
            --peach-puff-dark: #7d6d5e;
            --honeydew-dark: #787f78;
            --misty-rose-dark: #7d7070;
            --light-sky-blue-dark: #457b77;
            --light-salmon-dark: #7d553d;
            --cornsilk-dark: #7f7e6e;
            --lavender-blush-dark: #7f787a;
            --linen-dark: #7f7873;
        }
    </style>

    <style>
        .js-cat-color:hover {
            background-color: var(--hover-color) !important;
            color: var(--hover-text-color) !important;
        }

        .js-cat-color:hover>.js-cat-i {
            color: var(--hover-text-color) !important;
        }
    </style>
</x-layout.dashboard>
