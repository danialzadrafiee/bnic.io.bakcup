<widgects class="flex flex-col gap-12 @container" user-type="invidual">
    @if (!$isPublic || ($user->i_pub_first_name || $user->i_pub_last_name || $user->i_pub_country_primary || $user->i_pub_state_primary || $user->i_pub_country_secondary || $user->i_pub_state_secondary))
        <section>
            <label>Personal information</label>
            <grid class="grid grid-cols-3">
                @if (!$isPublic || ($user->i_pub_first_name || $user->i_pub_last_name))
                    <widgect class="_fullname relative">
                        <flex class="flex items-center px-2">
                            <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                                <x-fas-user class="w-[30px] h-[30px] text-primary "></x-fas-user>
                            </icon>
                            <in class="flex flex-col">
                                <header>
                                    FULL NAME
                                </header>
                                <value>
                                    @if (!$isPublic || $user->i_pub_first_name)
                                        <span>{{ $user->first_name }}</span>
                                    @else
                                        <span class='tooltip' data-tip='privite'>****</span>
                                    @endif
                                    @if (!$isPublic || $user->i_pub_last_name)
                                        <span>{{ $user->last_name }}</span>
                                    @else
                                        <span class='tooltip tooltip-bottom' data-tip='privite'>****</span>
                                    @endif
                                </value>
                            </in>
                        </flex>
                    </widgect>
                @endif
                @if (!$isPublic || ($user->i_pub_country_primary || $user->i_pub_state_primary))
                    <widgect class="_nationality-primary">
                        <flex class="flex items-center px-2">
                            <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                                <x-fas-home class="w-[30px] h-[30px] text-primary "></x-fas-home>
                            </icon>
                            <in class="flex flex-col">
                                <header>
                                    NATIONALITY <span class="text-xs block font-light">Primary</span>
                                </header>
                                <value>
                                    @if (!$isPublic || $user->i_pub_country_primary)
                                        <span>{{ $user->country_primary }}</span>
                                    @else
                                        <span class='tooltip' data-tip='privite'>****</span>
                                    @endif
                                    @if (!$isPublic || $user->i_pub_state_primary)
                                        <span>{{ $user->state_primary }}</span>
                                    @else
                                        <span class='tooltip tooltip-bottom' data-tip='privite'>****</span>
                                    @endif
                                </value>
                            </in>
                        </flex>
                    </widgect>
                @endif

                @if (!$isPublic || ($user->i_pub_country_secondary || $user->i_pub_state_secondary))
                    <widgect class="_nationality-secondary">
                        <flex class="flex items-center px-2">
                            <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                                <x-fas-home class="w-[30px] h-[30px] text-primary "></x-fas-home>
                            </icon>
                            <in class="flex flex-col">
                                <header>
                                    NATIONALITY <span class="text-xs block font-light">Secondary</span>
                                </header>
                                <value>
                                    @if ($user->i_pub_country_secondary)
                                        <span>{{ $user->country_secondary }}</span>
                                    @else
                                        <span class='tooltip' data-tip='privite'>****</span>
                                    @endif
                                    @if ($user->i_pub_state_secondary)
                                        <span>{{ $user->state_secondary }}</span>
                                    @else
                                        <span class='tooltip tooltip-bottom' data-tip='privite'>****</span>
                                    @endif
                                </value>
                            </in>
                        </flex>
                    </widgect>
                @endif
            </grid>
        </section>
    @endif

    @if (!$isPublic || ($user->i_pub_edu_field || $user->i_pub_edu_degree || $user->i_pub_edu_univercity || $user->i_pub_edu_country))
        <section class="flex flex-col gap-4">
            <label>Educational information</label>
            <grid class="grid grid-cols-2 @[800px]:grid-cols-4 ">
                @for ($i = 0; $i < count(json_decode($user->{"edu_field"})); $i++)
                    @if (!$isPublic || $user->i_pub_edu_field)
                        <widgect class="_field-of-study">
                            <flex class="flex items-center px-2">
                                <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                                    <x-fas-book class="w-[30px] h-[30px] text-primary "></x-fas-book>
                                </icon>
                                <in class="flex flex-col">
                                    <header>
                                        FIELD
                                    </header>
                                    <value>{{ json_decode($user->{"edu_field"})[$i] }}</value>
                                </in>
                            </flex>
                        </widgect>
                    @endif

                    @if (!$isPublic || $user->i_pub_edu_country)
                        <widgect class="_field-of-study">
                            <flex class="flex items-center px-2">
                                <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                                    <x-fas-flag-usa class="w-[30px] h-[30px] text-primary "></x-fas-flag-usa>
                                </icon>
                                <in class="flex flex-col">
                                    <header>
                                        COUNTRY
                                    </header>
                                    <value>{{ json_decode($user->{"edu_country"})[$i] }} </value>
                                </in>
                            </flex>
                        </widgect>
                    @endif

                    @if (!$isPublic || $user->i_pub_edu_univercity)
                        <widgect class="_field-of-study">
                            <flex class="flex items-center px-2">
                                <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                                    <x-fas-school class="w-[30px] h-[30px] text-primary "></x-fas-school>
                                </icon>
                                <in class="flex flex-col">
                                    <header>
                                        UNIVERCITY
                                    </header>
                                    <value>{{ json_decode($user->{"edu_univercity"})[$i] }}</value>
                                </in>
                            </flex>
                        </widgect>
                    @endif

                    @if (!$isPublic || $user->i_pub_edu_degree)
                        <widgect class="_degree">
                            <flex class="flex items-center px-2">
                                <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                                    <x-fas-graduation-cap class="w-[30px] h-[30px] text-primary ">
                                    </x-fas-graduation-cap>
                                </icon>
                                <in class="flex flex-col">
                                    <header>
                                        DEGREE
                                    </header>
                                    <value>{{ json_decode($user->{"edu_degree"})[$i] }}</value>
                                </in>
                            </flex>
                        </widgect>
                    @endif


                    <div class="col-span-2 @[800px]:col-span-4 block w-full h-[1px] bg-neutral-4  my-4"></div>
                @endfor


            </grid>
    @endif

    </section>

    @if (!$isPublic || ($user->i_pub_profession || $user->i_pub_skill || $user->i_pub_language))


        <section class="grid grid-cols-3 gap-x-4">
            <grid class="col-span-3">
                <label>Professional information</label>
            </grid>

            @if (!$isPublic || $user->i_pub_profession)
                <grid class="grid grid-cols-1">
                    @foreach (json_decode($user->{"profession"}) ?? [] as $profession)
                        <widgect class="_job">
                            <flex class="flex items-center px-2">
                                <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                                    <x-fas-briefcase class="w-[30px] h-[30px] text-primary "></x-fas-briefcase>
                                </icon>
                                <in class="flex flex-col">
                                    <header>
                                        JOB
                                    </header>
                                    <value>{{ $profession }}</value>
                                </in>
                            </flex>
                        </widgect>
                    @endforeach
                </grid>
            @endif

            @if (!$isPublic || $user->i_pub_skill)
                <grid class="grid grid-cols-1">
                    @foreach (json_decode($user->{"skill"}) ?? [] as $skill)
                        <widgect class="_skill">
                            <flex class="flex items-center px-2">
                                <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                                    <x-fas-wand-magic-sparkles class="w-[30px] h-[30px] text-primary ">
                                    </x-fas-wand-magic-sparkles>
                                </icon>
                                <in class="flex flex-col">
                                    <header>
                                        SKILL
                                    </header>
                                    <value>{{ $skill }}</value>
                                </in>
                            </flex>
                        </widgect>
                    @endforeach
                </grid>
            @endif

            @if (!$isPublic || $user->i_pub_language)
                <grid class="grid grid-cols-1">
                    @foreach (json_decode($user->{"language"}) ?? [] as $language)
                        <widgect class="_languages">
                            <flex class="flex items-center px-2">
                                <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 flex w-[60px] h-[60px]">
                                    <x-fas-earth-americas class="w-[30px] h-[30px] text-primary ">
                                    </x-fas-earth-americas>
                                </icon>
                                <in class="flex flex-col">
                                    <header>
                                        LANGUAGES
                                    </header>
                                    <value>{{ $language }}</value>
                                </in>
                            </flex>
                        </widgect>
                    @endforeach
                </grid>
            @endif

        </section>

        <section>
            <label>Personal details</label>
            <grid class="grid grid-cols-1">
                <widgect class="_code">
                    <flex class="flex items-center  px-2 gap-4">
                        <icon class="bg-primary/20 rounded-xl items-center justify-center shrink-0 grow-0 flex w-[60px] h-[60px]">
                            <x-fas-id-card-clip class="w-[30px] h-[30px] text-primary "></x-fas-id-card-clip>
                        </icon>
                        <in class="flex flex-col gap-1">
                            <header>
                                About Me
                            </header>
                            <value>
                                {!! $user->cv !!}
                            </value>
                        </in>
                    </flex>
                </widgect>
            </grid>
        </section>
    @endif

    @if (!$isPublic)
        <section>
            <label>Certificate Categories</label>
            <flex class="flex gap-4 w-full flex-wrap ">
                <widgect {{-- addCategoryModal --}} class="_category !bg-transparent w-full !p-0 mt-2 !shadow-none  grid gap-2 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 ">
                    <cat onclick="addCategotyModal.showModal()" class="shadow-sm  js-cat-color gap-2 w-full  rounded-md  flex flex-col items-center justify-center text-2xl aspect-square bg-white cursor-pointer hover:bg-primary hover:text-white ">
                        <x-fas-plus></x-fas-plus>
                        <span class="text-sm">
                            Add new
                        </span>
                    </cat>
                    {{-- showCategory --}}
                    @if ($user->categories()->count() != 0)


                        @foreach ($user->categories()->get() as $category)
                            <a href="{{ route('category.index', ['category_id' => $category->id]) }}"
                                class="js-category-edit js-cat-color shadow-sm gap-2 w-full  rounded-md  flex flex-col items-center justify-center text-2xl aspect-square bg-white cursor-pointer hover:bg-primary hover:text-white ">
                                <i class="js-cat-i fas {{ $category->icon }}"></i>
                                <span class="text-sm">
                                    {{ $category->name }}
                                </span>
                            </a>
                        @endforeach
                    @endif

                </widgect>
            </flex>
        </section>
    @endif
</widgects>
