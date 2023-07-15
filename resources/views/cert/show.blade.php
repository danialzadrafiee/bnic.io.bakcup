<x-layout.dashboard :user="$cert->corporation">
    @vite(['resources/js/cert-show.js'])

    <style>
        attachment .filepond--drop-label {
            background: #fafafa;
        }

        .js_file_input {
            display: none;
        }

        form input,
        form textarea {
            padding: 0px !important;
            border: transparent;
            background: transparent;
        }

        textarea {
            resize: none;
        }

        .css_delete {
            display: none !important;
        }

        .css_hide_it_in_show {
            display: none;
        }
    </style>


    @if ($watcher_rule == 'creator')
        <style>
            .filepond--file-info:not(attachment .filepond--file-info) {
                display: none;
            }

            .filepond--progress-indicator:not(attachment .filepond--progress-indicator) {
                display: none;
            }

            .filepond--file-action-button:not(attachment .filepond--file-action-button) {
                display: none;
            }

            .filepond--processing-complete-indicator:not(attachment .filepond--processing-complete-indicator) {
                display: none;
            }
        </style>
    @else
        <style>
            .filepond--file-info {
                display: none;
            }

            .filepond--progress-indicator {
                display: none;
            }


            .filepond--file-action-button {
                display: none;
            }

            .filepond--processing-complete-indicator {
                display: none;

            }
        </style>
    @endif
    <input type="hidden" class="js_nft_url" value="{{ route('cert.show', ['id' => $cert->id]) }}">
    <input type="hidden" class="js-cert-view-mode" value="{{ $mode ?? 'privite' }}">
    <input type="hidden" class="js-watcher-rule" value="{{ $watcher_rule ?? 'privite' }}">
    <input type="hidden" class="js-cert-id" value="{{ $cert->id ?? '' }}">
    <main class="flex">
        <article>


            <attachment class="px-8 bg-white rounded-xl h-max relative mb-4 flex-col pt-8 flex gap-4  py-4">
                <label class="text-sm">Attachment</label>
                <input type="file" value="" class="js_cert_attachment_input" name="cert_attachment">
            </attachment>


            <section class="js-cert-node bg-white py-20 px-5 -lg">
                <form class="bg-white max-w-full mx-auto relative">
                    {{-- @if (request()->has('success'))
                        <success
                            class="absolute rounded-lg w-full  py-4 flex top-[-65px] mx-auto items-center justify-center bg-[#c6ffd0] text-green-900">
                            <close class="absolute top-2 cursor-pointer right-2"
                                onclick="this.parentElement.style.display = 'none'">
                                <x-fas-times></x-fas-times>
                            </close>
                            {{ request('success') }}
                        </success>
                    @endif --}}
                    <header class="px-8 flex items-end justify-between">
                        <start class="flex text-sm justify-end items-end  gap-2">
                            <qr class="w-24 ">
                                <x-qrcode data="{{ route('cert.pub_show', ['id' => $cert->id]) }}"></x-qrcode>
                            </qr>
                            <column class="flex flex-col -mb-1">
                                <flex class="flex gap-2 items-center">
                                    <name class="text-base ">{{ $cert->name }}
                                    </name>
                                    <token class="js-cert-token block text-xs">{{ $cert->token }}</token>
                                </flex>
                                <description>{{ $cert->description }}</description>
                                <contract class="lowercase text-xs">{{ config('app.contract') }}
                                </contract>
                            </column>
                        </start>
                        <end>
                            @if ($cert->token != null)
                                <tooltip class="tooltip" data-tip="Token : {{ $cert->token }}"> <a href="https://mumbai.polygonscan.com/token/{{ config('app.contract') }}?a={{ $cert->token }}"
                                        class="font-normal  btn btn-sm btn-success gap-4 flex-row flex-nowrap w-full flex ">
                                        <span>
                                            Verified on blockchain
                                        </span>
                                    </a>
                                </tooltip>
                            @else
                                <input type="hidden" class="js_cert_has_reciver" value="{{ $cert->reciver != 0 ? 1 : 0 }}">
                                <tooltip class="tooltip js-cert-modal-tooltip" data-tip="It need to be verificated first">
                                    <button type="button" data-reciver="{{ $cert->reciver_verify }}" data-creator="{{ $cert->creator_verify }}"
                                        class="js-cert-sign-blockchain-modal font-normal normal-case btn btn-sm gap-2 flex-row flex-nowrap w-full flex ">
                                        <span>
                                            Create NFT
                                        </span>
                                        <badges class="flex gap-2 items-center">
                                            <div class="badge {{ $cert->creator_verify == 0 ? 'badge-neutral' : 'badge-success' }} badge-sm  rounded-full w-5 h-5 gap-2">
                                                C
                                            </div>
                                            @if ($cert->reciver != 0)
                                                <div class="badge {{ $cert->reciver_verify == 0 ? 'badge-neutral' : 'badge-success' }}  badge-sm  rounded-full w-5 h-5 gap-2">
                                                    R
                                                </div>
                                            @endif

                                        </badges>
                                    </button>
                                </tooltip>
                            @endif
                        </end>

                    </header>

                    <divider class="h-[0.5px] bg-neutral-5/10 block w-full px-8 mt-6 mb-2"></divider>
                    {!! $cert->data !!}
                </form>

                <form action="{{ route('cert.sign') }}" method="POST" class="js-form-real block w-full">
                    <input type="hidden" name="document_id" value="{{ $cert->id }}">
                    <input type="hidden" name="corporation_id" value="{{ $cert->corporation->id }}">
                    <input type="hidden" name="data" class="js-hidden-real-content">
                    <input type="hidden" name="name" value="{{ $cert->name }}">
                    <input type="hidden" name="image" value="{{ $cert->image }}">
                    <input type="hidden" name="description" value="{{ $cert->description }}">
                    <additional class="px-8 w-full pt-16 block">
                        <label>Additional people </label>
                        @foreach (json_decode($cert->ad_email) as $email)
                            <row class="js-row-additional pt-2  grid grid-cols-3 grid-flow-row justify-stretch w-full ">
                                <cel>
                                    <input class="js_additional_input" placeholder="Email" name="ad_email[]" value="{{ $email }}">
                                </cel>
                                <cel>
                                    <input class="js_additional_input" placeholder="Role" name="ad_role[]" value="{{ $cert->ad_role != null ? json_decode($cert->ad_role)[$loop->index] ?? '' : '' }}">
                                </cel>
                                <cel>
                                    <input class="js_additional_input" placeholder="Describe" value="{{ $cert->ad_role != null ? json_decode($cert->ad_describe)[$loop->index] ?? '' : '' }}">
                                </cel>
                            </row>
                        @endforeach
                    </additional>
                    <divider class="h-[0.5px] bg-neutral-5/10 block w-full px-8 my-6 "></divider>
                    <signatures class="grid grid-cols-3 gap-x-8 w-full  px-8 ">
                        <column class="col-span-3">
                            <label class="text-lg">Signatures</label>
                        </column>
                        {{-- resiver --}}
                        @if ($cert->reciver !== '0')
                            @if ($cert->reciver_verify == 0)
                                <column class="col-span-1">
                                    <card class="block max-w-sm py-6 bg-white  ">
                                        <h5 class="mb-2 tracking-tight text-black/90 ">
                                            Reciver</h5>
                                        <p class="border  w-full aspect-square  flex items-center justify-center  ">
                                            Pending
                                        </p>
                                    </card>
                                </column>
                            @endif
                            @if ($cert->reciver_verify == 1)
                                @php
                                    $profile_qrcode_id = App\Models\User::where('email', $cert->reciver)->first()->profile_nft_id;
                                    $profile_qrcode_id ? ($profile_qrcode_json = str_replace('.json', '.png', App\Models\Nft::where('id', $profile_qrcode_id)->first()->url)) : ($profile_qrcode_json = null);
                                @endphp
                                <column class="col-span-1">
                                    <card class="block max-w-sm py-6 bg-white  ">
                                        <h5 class="mb-2 tracking-tight text-black/90 ">
                                            Reciver</h5>
                                        <p class=" bg-neutral-5/10  w-full aspect-square  flex items-center justify-center ">
                                            @if ($profile_qrcode_json)
                                                <img src="{{ $profile_qrcode_json }}" class="w-full h-full  p-4 ">
                                            @else
                                                <span class=" px-8 flex flex-col items-center justify-center text-center">Signed<small>The
                                                        creator has reciver the cert, but their account is not
                                                        verified.</small></span>
                                            @endif
                                        </p>


                                    </card>
                                </column>
                            @endif
                        @endif
                        {{-- creator --}}
                        @if ($cert->creator_verify == 0)
                            <column class="col-span-1">
                                <card class="block max-w-sm py-6 bg-white  ">
                                    <h5 class="mb-2 tracking-tight text-black/90 ">
                                        Creator</h5>
                                    <p class="border  w-full aspect-square  flex items-center justify-center  ">
                                        Pending
                                    </p>
                                </card>
                            </column>
                        @endif
                        @if ($cert->creator_verify == 1)
                            @php
                                $profile_qrcode_id = App\Models\User::where('id', $cert->corporation_id)->first()->profile_nft_id;
                                $profile_qrcode_id ? ($profile_qrcode_json = str_replace('.json', '.png', App\Models\Nft::where('id', $profile_qrcode_id)->first()->url)) : ($profile_qrcode_json = null);
                            @endphp
                            <column class="col-span-1">
                                <card class="block max-w-sm py-6 bg-white  ">
                                    <h5 class="mb-2 tracking-tight text-black/90 ">
                                        Creator</h5>
                                    <p class=" bg-neutral-5/10  w-full aspect-square  flex items-center justify-center ">
                                        @if ($profile_qrcode_json)
                                            <img src="{{ $profile_qrcode_json }}" class="w-full h-full  p-4 ">
                                        @else
                                            <span class=" px-8 flex flex-col items-center justify-center text-center">Signed<small>The
                                                    creator has signed the cert, but their account is not
                                                    verified.</small></span>
                                        @endif
                                    </p>
                                </card>
                            </column>
                        @endif
                        {{-- requester --}}
                        @php
                            $profile_qrcode_id = App\Models\User::where('id', $cert->user_id)->first()->profile_nft_id;
                            $profile_qrcode_id ? ($profile_qrcode_json = str_replace('.json', '.png', App\Models\Nft::where('id', $profile_qrcode_id)->first()->url)) : ($profile_qrcode_json = null);
                        @endphp
                        <column class="col-span-1">
                            <card class="block max-w-sm py-6 bg-white  ">
                                <h5 class="mb-2 tracking-tight text-black/90 ">
                                    Requester</h5>
                                <p class=" bg-neutral-5/10  w-full aspect-square  flex items-center justify-center ">
                                    @if ($profile_qrcode_json)
                                        <img src="{{ $profile_qrcode_json }}" class="w-full h-full  p-4 ">
                                    @else
                                        <span class=" px-8 flex flex-col items-center justify-center text-center">Signed<small>The
                                                requester has signed the cert, but their account is not
                                                verified.</small></span>
                                    @endif

                                </p>
                            </card>
                        </column>
                    </signatures>
                </form>
                @if ($watcher_rule == 'reciver')
                    <reciver_verification class="px-8 flex items-center  mx-auto">
                        @if ($cert->reciver_verify == 0)
                            <a href="{{ route('cert.verify', ['id' => $cert->id, 'watcher_mod' => $watcher_rule]) }}" class="js-verify-certificate btn btn-primary">Verify
                                this
                                certificate as reciver</a>
                        @else
                            <a disabled class="js-verify-certificate bg-neutral rounded-lg text-white text-center px-4 py-2">Allready
                                verified</a>
                        @endif
                    </reciver_verification>
                @endif
                @if ($watcher_rule == 'creator')
                    <creator_verification class="px-8 flex items-center  mx-auto">
                        @if ($cert->creator_verify == 0)
                            <a href="{{ route('cert.verify', ['id' => $cert->id, 'watcher_mod' => $watcher_rule]) }}" class="js-verify-certificate btn btn-primary">Verify
                                this
                                certificate as creator</a>
                        @else
                            <a disabled class="js-verify-certificate rounded bg-neutral  text-white text-center px-4 py-2">Allready
                                verified</a>
                        @endif
                    </creator_verification>
                @endif
            </section>
            </button>
        </article>
    </main>
    </x-layout.dashboard-corporation>
