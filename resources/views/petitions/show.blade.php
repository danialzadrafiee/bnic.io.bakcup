@php
    $creator = $petition
        ->users()
        ->wherePivot('user_role', 'creator')
        ->first();
    $creator_fullname = $creator->user_type == 'invidual' ? $creator->first_name . ' ' . $creator->last_name : $creator->corp_name;
    $signed = $petition
        ->users()
        ->wherePivot('user_role', 'signer')
        ->count();
@endphp
<x-layout.dashboard :user="auth()->user()">
    @vite('resources/js/petition-show.js')
    <div class="container js_petition_dom">
        <input type="hidden" class="js_petition_id" value="{{ $petition->id }}">
        <div class="bg-white rounded-xl shadow-sm mt-8  flex flex-col gap-4 p-16">
            <header class="flex flex-col items-center  justify-center">
                <figure class="relative w-full">
                    <row class=" absolute bg-white rounded-lg text-sm px-4 py-2 top-4 right-4">
                        {{ $signed }} Users has signed this petition

                    </row>
                    <img class="h-48 w-full rounded-lg  object-cover"
                        src="{{ $petition->picture ?? 'https://api.dicebear.com/6.x/initials/svg?seed=' . $petition->title }}">
                    <qr
                        class="rounded-xl p-4 bg-white flex shadow absolute top-12 left-0 right-0 mx-auto w-max items-center justify-center">
                        <x-qrcode data="test" class="w-36 h-36"></x-qrcode>
                    </qr>
                </figure>
                @if ($petition->token == null)
                    <button
                        class="btn btn-neutral mt-12 btn-sm w-max mx-auto normal-case btn_generate_petition_nft flex">Generate
                        NFT</button>
                @else
                    <button
                        class="js_btn_show_nft  pointer-events-none  mt-12 btn-sm w-max btn normal-case btn-success">Petition
                        is
                        on blockchain</button>
                @endif
                <h2 class="text-2xl font-semibold mt-2">
                    {{ $petition->title }}
                </h2>
                <h3 class="lowercase mt-1">#{{ str_replace(' ', '_', $petition->hashtag) }}</h3>
            </header>
            <content class="flex h-max w-full mt-4 items-center   ">
                <p class="break-all  ">
                    {{ $petition->content }}
                </p>
            </content>
            <row class="mt-12 border-t pb-12  pt-12">

                <grid class="grid grid-flow-row px-5 grid-cols-2 gap-4">
                    <cel>
                        <ul class="list-disc">
                            <li> <span>Petition start:
                                    {{ \Carbon\Carbon::parse($petition->created_at)->format('M d, Y') }} </span></li>
                            <li> <span>Petition end: {{ \Carbon\Carbon::parse($petition->end_at)->format('M d, Y') }}
                                </span></li>
                        </ul>
                    </cel>
                    <cel>
                        <ul class="list-disc">
                            <li> <span>Creator: {{ $creator_fullname }} </span></li>
                            <li> <span>Type: {{ $petition->anonymous ? 'Anonymous' : 'Public' }}
                            </li>
                        </ul>
                    </cel>
                </grid>
            </row>
            <row class="flex border-t pt-10 flex-col gap-2">
                <div class="flex justify-between items-center">
                    <left>
                        Petition SoftCap
                    </left>
                    <right class="text-sm">
                        {{ $signed . '/' . $petition->min }}
                    </right>
                </div>
                <prog class="rounded-full w-full bg-[#d2d2d3] h-8">
                    <filler class="rounded-full h-8 text-white items-center  justify-end pr-2 text-sm flex bg-primary "
                        style="width:{{ ($signed / $petition->min) * 100 > 5 ? ($signed / $petition->min) * 100 : 5 }}%">
                        {{ ceil(($signed / $petition->min) * 100) }} %
                    </filler>

                </prog>

            </row>

            <row class="flex items-center w-full gap-4 mt-4">
                <form action="{{ route('petitions.sign', $petition) }}" method="post"
                    class="flex items-center w-full justify-center">
                    @csrf
                    <button type="submit" class="btn mx-auto btn-primary">
                        <x-fas-signature class="mr-2" />
                        Sign this Petition
                    </button>
                </form>
                @if (auth()->user()->id ==
                        $petition->users()->wherePivot('user_role', 'creator')->first()->id)
                    <form action="{{ route('petitions.destroy', $petition) }}" method="post">
                        @csrf
                        @method('DELETE')
                        @php
                            $canDelete =
                                $petition
                                    ->users()
                                    ->wherePivot('user_role', 'signer')
                                    ->count() < 10;
                            $errorMessage = $errors->first('error') ?? '';
                        @endphp

                        <tooltip class="{{ $canDelete && 'tooltip' }} hidden" data-tip="{{ $errorMessage }}">
                            <button type="submit"
                                class="{{ $canDelete ? 'inline-flex' : 'opacity-50 cursor-not-allowed' }} btn-error btn">
                                <x-fas-trash-alt class="mr-2" />
                                Delete this Petition
                            </button>
                        </tooltip>
                    </form>
                @endif
            </row>


        </div>

</x-layout.dashboard>
