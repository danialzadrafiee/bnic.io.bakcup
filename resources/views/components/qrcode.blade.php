@vite(['resources/js/qrcode.js'])
<input type="hidden" class="js-qr-data" value="{{ $data }}">
<img class="js-qr-image {{ $class ?? '' }} block">
