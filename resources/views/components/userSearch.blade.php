{{-- it will return user-id inside <input type="hidden" class="xjs-selected-user">  --}}
@vite(['resources/js/app.js', 'resources/js/components/userSearch.js'])
@php
    $id = $id ?? 'search';
    $buttonClass = $buttonClass ?? '';
    $users = \App\Models\User::where('user_type', 'invidual')
        ->take(10)
        ->get();
@endphp
