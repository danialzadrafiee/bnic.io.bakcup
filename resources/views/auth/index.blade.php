<x-layout.auth>
    @vite(['resources/js/app.js', 'resources/js/auth-index.js'])
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #ffffff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 12px;
            width: 30%;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            padding: 10px 16px;
            color: black;
            font-size: 20px;
            border-bottom: 1px solid #ddd;
        }

        .modal-body {
            padding: 10px 16px;
        }

        .modal-button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #5956E9;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>



    <main class="relative min-h-screen overflow-hidden">
        <div class="absolute w-full -z-50 h-full pointer-events-none">
            <div class="absolute right-0 top-0 max-w-[50vw] max-h-screen background__right">
                <img class="block max-w-[50vw] max-h-[100vh]" src="{{ asset('img/auth/auth-background-right.png') }}">
            </div>
            <div class="absolute bottom-0 left-0 w-[50vw] max-h-screen background__left">
                <img class="block max-w-[50vw] max-h-[100vh]" src="{{ asset('img/auth/auth-background-left.svg') }}">
            </div>
        </div>
        <aside class="py-16 px-24 max-w-[1512px] mx-auto flex flex-col justify-center h-screen 3xl:gap-32 gap-16">
            <header class="mb-auto">
                <div class="header__logo">
                    <img class="h-10 block" src="{{ asset('img/global/logo-dark.svg') }}">
                </div>
            </header>
            <div class="flex flex-col 3xl:gap-10 gap-8 mb-auto">
                <div class="content__title text-8xl font-extrabold">
                    <span class="text-[#292930] block">Bnic.io</span>
                    <span class="text-[#292930] block">Manage your</span>
                    <span class="block text#5956E9">Decentral<br>Identity</span>
                </div>
                <div class="content__subtitle text-xl max-w-[30vw] block">
                    Create your Decentral identity and unlock new opportunities in the digital world.
                </div>
                <div class="content__buttons flex scale-150 origin-left ">
                    <w3m-core-button size="500"></w3m-core-button>
                </div>
            </div>
        </aside>
    </main>

</x-layout.auth>
