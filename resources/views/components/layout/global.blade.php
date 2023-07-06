@php
    header('Access-Control-Allow-Origin: *');
@endphp
<!doctype html>
<html data-theme="bnic" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="global-auth-user" content="{{ json_encode(auth()->user()) }}">
    <script>
        const GLOBAL_AUTH_USER = JSON.parse(document.querySelector('meta[name="global-auth-user"]').getAttribute(
            "content"));
    </script>
    <title>Bnic.io</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js', 'resources/js/footer.js'])
    <style>
        @import url('https://fonts.cdnfonts.com/css/poppins');
        @import url('https://fonts.cdnfonts.com/css/inter');

        html,
        body {
            font-family: 'Poppins', sans-serif;
        }

        .font-inter {
            font-family: 'Inter', sans-serif !important;
        }


        .loading-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999999999;
            background-color: white;
        }

        .loading-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid #fff;
            border-top-color: #0062ff;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body>
    @routes
    <loading class="loading-container">
        <circle class="loading-circle"></circle>
    </loading>

    @if (session('success'))
        <global_alert_success class="js-g-alert fixed bottom-4 w-[50vw] z-50 right-0 left-0 mx-auto">
            <div class=" alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Your purchase has been confirmed!</span>
                <div>
                    <button class="js-g-alert-close btn btn-circle btn-sm btn-outline"
                        onclick="this.closest('.js-g-alert').style.display = 'none'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </global_alert_success>
        <script>
            let timer = setTimeout(function() {
                let element = document.querySelector('.js-g-alert');
                if (element) {
                    element.style.display = 'none';
                }
            }, 4000);
        </script>
    @endif




    {{ $slot }}

    @vite('resources/css/override.scss')

</body>

</html>
