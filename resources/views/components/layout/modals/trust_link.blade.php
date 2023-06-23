      {{-- TrustLink modal --}}
      <dialog id="turst_link_modal" class="modal">
          <form method="dialog" class="modal-box flex flex-col gap-2">
              <button for="my-modal-3" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
              <input type="text" autofocus class="w-0 h-0">
              <heading class="text-lg font-medium ">TrustLink network</heading>
              @foreach ($user->trusters as $truster)
                  <card class="card bg-base-100 shadow-xl">
                      <frow class="card-body flex flex-row justify-between items-center">
                          <frow class="flex flex-row gap-4">
                              <img class="w-12 rounded aspect-square"
                                  src="https://api.dicebear.com/6.x/shapes/svg?seed={{ $truster->user_type == 'invidual' ? $truster->first_name . ' ' . $truster->last_name : $truster->corp_name }}">
                              <fcol class="flex flex-col">
                                  <name class="font-semibold capitalize">
                                      {{ $truster->user_type == 'invidual' ? $truster->first_name . ' ' . $truster->last_name : $truster->corp_name }}
                                  </name>
                                  <type class="font-light capitalize">
                                      {{ $truster->user_type }}
                                  </type>
                              </fcol>
                          </frow>
                          <frow>
                              <a href="{{ route('dashboard.public_index', $truster->id) }}" type="button"
                                  class="btn btn-sm btn-neutral">Visit Profile</a>
                          </frow>
                      </frow>
                  </card>
              @endforeach
          </form>
          <form method="dialog" class="modal-backdrop">
              <button>close</button>
          </form>
      </dialog>
