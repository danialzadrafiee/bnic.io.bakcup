           <!-- Main modal -->
           <dialog id="sign_wallet_modal" class="modal">
               <style>
                   .modal-box::-webkit-scrollbar {
                       width: 0 !important;
                   }
               </style>
               <form method="dialog" class="w-full max-w-md modal-box p-0 ">
                   <!-- Modal content -->
                   <div class="">
                       <!-- Modal header -->
                       <div class="flex items-start justify-between p-4 border-b rounded-t ">
                           <h3 class="text-xl normal-case font-semibold text-neutral-900 ">
                               Upload profile on blockchain
                           </h3>
                           <button for="sign_wallet_modal" class="text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center ">
                               <x-fas-xmark></x-fas-xmark>
                           </button>

                       </div>
                       <!-- Modal body -->
                       <div class="p-6 space-y-6 flex flex-col items-center">
                           {{-- NFT Box --}}
                           <nft class="js-nft-box w-[300px] h-[320px] border bg-white flex items-center gap-2.5 py-4 px-0 rounded border-neutral/50 flex-col ">
                               <code>
                                   @if ($user->user_type == 'invidual')
                                       <span class="uppercase">
                                           {{ $user->gender[0] }}-{{ substr(hash('sha256', $user->email), 0, 8) }}-{{ $user->id }}-<span contenteditable class="js-span-token">{{ $user->token }}</span>
                                       </span>
                                   @else
                                       <span class="uppercase">
                                           {{ $user->corp_type[0] }}-{{ substr(hash('sha256', $user->email), 0, 8) }}-{{ $user->id }}-<span contenteditable class="js-span-token">{{ $user->token }}</span>
                                       </span>
                                   @endif
                               </code>
                               <qrcode class="flex items-center justify-center">
                                   <design class="bg-base-content block w-[46px] h-[60px]">
                                   </design>
                                   <div class="js-nft-qrcode !h-[220px]">
                                       <div class="addhere"></div>
                                       <x-qrcode data="{{ route('dashboard.public_index', ['user_id' => $user->id]) }}"></x-qrcode>
                                   </div>
                                   <design class="bg-base-content block w-[46px] h-[60px]">
                                   </design>
                               </qrcode>
                               <name class="text-sm capitalize">
                                   <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                               </name>
                           </nft>
                           <p class="text-base leading-relaxed text-center text-neutral-500 ">
                               To activate your account, you need to upload your profile on Blockpin. After doing this,
                               the contract will receive its profile in the form of an nft token, which will be visible
                               in your wallet.
                           </p>
                       </div>
                       <!-- Modal footer -->
                       <div class="flex items-center justify-center p-6 space-x-2 border-t border-neutral-200 rounded-b">

                           <button for="sign_wallet_modal" class="btn btn-neutral">Decline</button>
                           <button data-id={{ $user->id }} type="button" class="js-btn-signchain-submit btn btn-primary">Generate
                               Profile NFT</button>
                       </div>
                   </div>
               </form>
               <form method="dialog" class="modal-backdrop">
                   <button>close</button>
               </form>
           </dialog>
