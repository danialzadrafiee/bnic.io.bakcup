@php
    $me = auth()->user();
    $user_type = $me->user_type;
@endphp


<x-layout.dashboard :user="$me">
    @vite('resources/css/admin-index.scss')
    @vite('resources/js/admin-index.js')
    <inviduals class="overflow-x-auto">
        <label class="block font-semibold text-xs pt-2">Inviduals</label>
        <table class="table">
            <thead>
                <tr>
                    <td>#id </td>
                    <td>Admin </td>
                    <td>profile_nft_id</td>
                    <td>token</td>
                    <td>first_name</td>
                    <td>last_name</td>
                    <td>birthday</td>
                    <td>gender</td>
                    <td>email</td>
                    <td>country_primary</td>
                    <td>state_primary</td>
                    <td>country_secondary</td>
                    <td>state_secondary</td>
                    <td>wallet</td>
                    <td>edu_country</td>
                    <td>edu_univercity</td>
                    <td>edu_field</td>
                    <td>edu_degree</td>
                    <td>profession</td>
                    <td>skill</td>
                    <td>language</td>
                    <td>inviter_email </td>
                    <td>is_fee_paid </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if ($user->user_type == 'invidual')
                        <tr user_id="{{ $user->id }}">
                            <td for="id" data_readonly="1">{{ $user->id }}</td>
                            <td for="isAdmin" data_readonly="1"> <input user_id="{{ $user->id }}" type="checkbox" class="js_is_admin toggle-primary toggle toggle-xs" {{ $user->isAdmin ? 'checked' : '' }}> </td>
                            <td for="profile_nft_id">{{ $user->profile_nft_id }}</td>
                            <td for="token">{{ $user->token }}</td>
                            <td for="first_name" data_readonly="1">{{ $user->i_pub_first_name == 1 ? $user->first_name : '*****' }}</td>
                            <td for="last_name" data_readonly="1">{{ $user->i_pub_last_name == 1 ? $user->last_name : '*****' }}</td>
                            <td for="birthday">{{ $user->i_pub_birthday == 1 ? $user->birthday : '*****' }}</td>
                            <td for="gender">{{ $user->i_pub_gender == 1 ? $user->gender : '*****' }}</td>
                            <td for="email">{{ $user->i_pub_email == 1 ? $user->email : '*****' }}</td>
                            <td for="country_primary">{{ $user->i_pub_country_primary == 1 ? $user->country_primary : '*****' }}</td>
                            <td for="state_primary">{{ $user->i_pub_state_primary == 1 ? $user->state_primary : '*****' }}</td>
                            <td for="country_secondary">{{ $user->i_pub_country_secondary == 1 ? $user->country_secondary : '*****' }}</td>
                            <td for="state_secondary">{{ $user->i_pub_state_secondary == 1 ? $user->state_secondary : '*****' }}</td>
                            <td for="wallet">{{ $user->i_pub_wallet == 1 ? $user->wallet : '*****' }}</td>
                            <td for="edu_country">{{ $user->i_pub_edu_country == 1 ? $user->edu_country : '*****' }}</td>
                            <td for="edu_univercity">{{ $user->i_pub_edu_univercity == 1 ? $user->edu_univercity : '*****' }}</td>
                            <td for="edu_field">{{ $user->i_pub_edu_field == 1 ? $user->edu_field : '*****' }}</td>
                            <td for="edu_degree">{{ $user->i_pub_edu_degree == 1 ? $user->edu_degree : '*****' }}</td>
                            <td for="profession">{{ $user->i_pub_profession == 1 ? $user->profession : '*****' }}</td>
                            <td for="skill">{{ $user->i_pub_skill == 1 ? $user->skill : '*****' }}</td>
                            <td for="language">{{ $user->i_pub_language == 1 ? $user->language : '*****' }}</td>
                            <td for="inviter_email" data_readonly="1">{{ $user->inviter_email }} </td>
                            <td for="is_fee_paid" data_readonly="1"><input user_id="{{ $user->id }}" type="checkbox" class="is_fee_paid toggle-primary toggle toggle-xs" {{ $user->is_fee_paid ? 'checked' : '' }}> </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

    </inviduals>
    <inviduals class="overflow-x-auto mt-8">
        <label class="block font-semibold text-xs pt-2">Corporations</label>
        <table class="table">
            <thead>
                <tr>
                    <td>#id </td>
                    <td>Admin </td>
                    <td>profile_nft_id</td>
                    <td>token</td>
                    <td>corp_name</td>
                    <td>corp_establishment</td>
                    <td>corp_cat_pri</td>
                    <td>corp_cat_sec</td>
                    <td>corp_type</td>
                    <td>corp_country_pri</td>
                    <td>corp_state_pri</td>
                    <td>corp_country_sec</td>
                    <td>corp_state_sec</td>
                    <td>corp_form</td>
                    <td>corp_link</td>
                    <td>corp_cv</td>
                    <td>corp_file</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if ($user->user_type == 'corporation')
                        <tr user_id="{{ $user->id }}">
                            <td for="id">{{ $user->id }}</td>
                            <td for="isAdmin" data_readonly="1"> <input user_id="{{ $user->id }}" type="checkbox" class="js_is_admin toggle-primary toggle toggle-xs" {{ $user->isAdmin ? 'checked' : '' }}> </td>
                            <td for="profile_nft_id">{{ $user->profile_nft_id }}</td>
                            <td for="token">{{ $user->token }}</td>
                            <td for="corp_name">{{ $user->corp_name }}</td>
                            <td for="corp_establishment">{{ $user->corp_establishment }}</td>
                            <td for="corp_cat_pri">{{ $user->corp_cat_pri }}</td>
                            <td for="corp_cat_sec">{{ $user->corp_cat_sec }}</td>
                            <td for="corp_type">{{ $user->corp_type }}</td>
                            <td for="corp_country_pri">{{ $user->corp_country_pri }}</td>
                            <td for="corp_state_pri">{{ $user->corp_state_pri }}</td>
                            <td for="corp_country_sec">{{ $user->corp_country_sec }}</td>
                            <td for="corp_state_sec">{{ $user->corp_state_sec }}</td>
                            <td for="corp_form">{{ $user->corp_form }}</td>
                            <td for="corp_link">{{ $user->corp_link }}</td>
                            <td for="corp_cv">{{ $user->corp_cv }}</td>
                            <td for="corp_file">{{ $user->corp_file }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

    </inviduals>
</x-layout.dashboard>





























$table->id();
//global





$table->string('user_type');
$table->longText('cv')->nullable();
$table->string('website')->nullable();
$table->string('facebook')->nullable();
$table->string('twitter')->nullable();
$table->string('instagram')->nullable();
$table->string('linkedin')->nullable();
$table->string('youtube')->nullable();
$table->string('telegram')->nullable();
$table->string('profile_picture')->nullable();
$table->string('wallpaper_image')->nullable();
$table->string('profile_nft_id')->nullable();
$table->string('token')->nullable();

//invidual
$table->string('first_name')->nullable();
$table->string('last_name')->nullable();
$table->date('birthday')->nullable();
$table->string('gender')->nullable();
$table->string('email')->unique();
$table->string('country_primary')->nullable();
$table->string('state_primary')->nullable();
$table->string('country_secondary')->nullable();
$table->string('state_secondary')->nullable();
$table->string('wallet')->nullable();
$table->json('edu_country')->nullable();
$table->json('edu_univercity')->nullable();
$table->json('edu_field')->nullable();
$table->json('edu_degree')->nullable();
$table->json('profession')->nullable();
$table->json('skill')->nullable();
$table->json('language')->nullable();

//invidual_publicity
$table->string('i_pub_first_name')->default(1);
$table->string('i_pub_last_name')->default(1);
$table->date('i_pub_birthday')->default(1);
$table->string('i_pub_gender')->default(1);
$table->string('i_pub_email')->default(1);
$table->string('i_pub_country_primary')->default(1);
$table->string('i_pub_state_primary')->default(1);
$table->string('i_pub_country_secondary')->default(1);
$table->string('i_pub_state_secondary')->default(1);
$table->string('i_pub_wallet')->default(1);
$table->json('i_pub_edu_country')->default(1);
$table->json('i_pub_edu_univercity')->default(1);
$table->json('i_pub_edu_field')->default(1);
$table->json('i_pub_edu_degree')->default(1);
$table->json('i_pub_profession')->default(1);
$table->json('i_pub_skill')->default(1);
$table->json('i_pub_language')->default(1);


//corporation

//corporation_publicity
$table->string('pub_corp_name')->default(1);
$table->string('pub_corp_establishment')->default(1);
$table->string('pub_corp_cat_pri')->default(1);
$table->string('pub_corp_cat_sec')->default(1);
$table->string('pub_corp_type')->default(1);
$table->string('pub_corp_country_pri')->default(1);
$table->string('pub_corp_state_pri')->default(1);
$table->string('pub_corp_country_sec')->default(1);
$table->string('pub_corp_state_sec')->default(1);
$table->string('pub_corp_form')->default(1);
$table->string('pub_corp_link')->default(1);
$table->string('pub_corp_cv')->default(1);
$table->string('pub_corp_file')->default(1);

//admin
$table->string('isAdmin')->default(0);
$table->string('inviter_email')->nullable()->default(0);
$table->string('is_fee_paid')->nullable()->default(1);
