  @foreach ($certs as $cert)
      <card class="js-card-template card w-full bg-base-100 shadow-xl relative">
          <figure class="relative">
              <img src="https://api.dicebear.com/6.x/shapes/svg?seed={{ $cert->name }}" class="w-full" />
              <flex class="flex items-center gap-4 absolute badge badge-neutral bottom-4 h-8 text-xs left-4 ">
                  <date class="text-xs flex gap-1  items-center">
                      <x-far-calendar class="w-3 h-3" />
                      <span class="mt-0.5">
                          <ref class="js-card-date">{{ date('m d, Y', strtotime($cert->created_at)) }}</ref>

                      </span>
                  </date>
                  <clock class="text-xs flex gap-1  items-center">
                      <x-far-clock class="w-3 h-3" />
                      <span class="mt-0.5">
                          <ref class="js-card-date">{{ date('h:i', strtotime($cert->created_at)) }}</ref>
                      </span>
                  </clock>
              </flex>
          </figure>
          <badges class="card-actions justify-end absolute top-4 right-4">
              <div class="js-badge-creator badge {{ $cert->creator_verify ? 'badge-accent' : 'badge-warning' }}">Creator</div>
              <div class="js-badge-reciver badge {{ $cert->reciver_verify ? 'badge-accent' : 'badge-warning' }}">Reciver</div>
          </badges>

          <card-body class="card-body p-4">
              <subject class="font-medium">
                  <ref class="js-card-subject">{{ $cert->name }}</ref>
              </subject>
              <description class="text-sm">
                  <ref class="js-card-description">{{ $cert->description }}</ref>
              </description>
              <divider class="divider my-0"></divider>
              <metadata class="py-2 flex flex-col gap-1">
                  <creator class="text-sm flex justify-between tooltip tooltip-left" data-tip="Creator">
                      <icon class="flex items-center gap-1">
                          <x-fas-right-from-bracket />
                          <span> Creator </span>
                      </icon>
                      <value>
                          <ref class="js-card-creator capitalize">
                              @php
                                  $creator = \App\Models\User::where('id', $cert->corporation_id);
                              @endphp
                              @if ($creator->count() != 0)
                              @endif
                              {!! $creator->first()->corporation_id == 'invidual' ? $creator->first()->first_name . ' ' . $creator->first()->last_name : $creator->first()->corp_name !!}
                          </ref>
                      </value>
                  </creator>
                  <requester class="text-sm flex justify-between tooltip tooltip-left" data-tip="Requester">
                      <icon class="flex items-center gap-1">
                          <x-fas-user />
                          <span>Requester </span>
                      </icon>
                      <value>
                          <span>
                              <ref class="js-card-requester capitalize">
                                  @php
                                      $requester = \App\Models\User::where('id', $cert->user_id)->first();
                                  @endphp
                                  {!! $requester->user_type == 'invidual' ? $requester->first_name . ' ' . $requester->last_name : $requester->corp_name !!}
                              </ref>
                          </span>
                      </value>
                  </requester>
                  @php
                      $reciver = \App\Models\User::where('email', $cert->reciver);
                  @endphp
                  @if ($reciver->count() != 0)
                      <reciver class="text-sm flex justify-between tooltip tooltip-left" data-tip="Reciver">
                          <icon class="flex items-center gap-1">
                              <x-fas-eye />
                              <span>Reciver </span>
                          </icon>
                          <value>
                              <span>
                                  <ref class="js-card-requester capitalize">
                                      {!! $reciver->first()->corporation_id == 'invidual' ? $reciver->first()->first_name . ' ' . $reciver->first()->last_name : $reciver->first()->corp_name !!}
                                  </ref>
                              </span>
                          </value>
                      </reciver>
                  @endif
              </metadata>
              <actions>
                  <a href="{{ route('cert.pub_show', ['id' => $cert->id]) }}" class="js-card-action btn btn-neutral hover:btn-primary w-full ">Watch
                      certificate</a>
              </actions>
          </card-body>
      </card>
  @endforeach
