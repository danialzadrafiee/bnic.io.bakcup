@php
    $corporations = \App\Models\User::where('user_type', 'corporation')->get();
    $menuItems = [
        ['cat' => 'prescription', 'icon' => 'prescription', 'text' => 'prescription', 'active' => true],
        ['cat' => 'projects', 'icon' => 'projects', 'text' => 'projects'],
        ['cat' => 'records', 'icon' => 'records', 'text' => 'records'],
        ['cat' => 'teams', 'icon' => 'teams', 'text' => 'teams'],
        ['cat' => 'universities', 'icon' => 'universities', 'text' => 'universities'],
        ['cat' => 'vaccination', 'icon' => 'vaccination', 'text' => 'vaccination'],
        ['cat' => 'academies', 'icon' => 'academies', 'text' => 'academies'],
        ['cat' => 'achivments', 'icon' => 'achivments', 'text' => 'achivments'],
        ['cat' => 'banking', 'icon' => 'banking', 'text' => 'banking'],
        ['cat' => 'certificates', 'icon' => 'certificates', 'text' => 'certificates'],
        ['cat' => 'companies', 'icon' => 'companies', 'text' => 'companies'],
        ['cat' => 'idcard', 'icon' => 'idcard', 'text' => 'idcard'],
        ['cat' => 'membrance', 'icon' => 'membrance', 'text' => 'membrance'],
        ['cat' => 'passport', 'icon' => 'passport', 'text' => 'passport'],
    ];
@endphp
<dialog id="js_modal_categories" class="js-modal-categories modal">
    <form method="dialog" class="modal-box w-11/12 max-w-5xl">
        <navigation class="pb-4">
            <actions>
                <search>
                    <field>
                        <input type="text" class="js-input-search" placeholder="Ex : Berkshire Hathaway" />
                        <div>
                            <i class="fas fa-search"></i>
                        </div>
                    </field>
                    <button type="button" class="js-btn-search">
                        Search
                    </button>
                </search>
            </actions>
        </navigation>
        <inside>
            <data class="js-section-corp-data  h-[500px] overflow-y-scroll py-4 flex flex-col gap-4 border-neutral/20 px-4">



            </data>
        </inside>
        </div>
        <button class="js-btn-categories-close text-primary/80 absolute bottom-4 right-8">close</button>
        </div>
    </form>
</dialog>
<templates>
    <corporation class="corporation-template">
        <inside class="grid grid-cols-5 py-2">
            <column class="col-span-3 flex gap-2  ">
                <img class="w-[85px] h-[85px] rounded" src="" />
                <flex class="flex flex-col">
                    <name class="font-medium">
                    </name>
                    <describe class="text-sm">
                        <detail>
                        </detail>
                    </describe>
                </flex>
            </column>
            <column class="col-span-2 ml-auto grid gap-8 grid-cols-2 text-sm">
                <flex class="col-span-1 flex flex-col gap-1">
                    <tag>
                        <label class="font-light">Type</label>
                        <type class="font-medium"></type>
                    </tag>
                    <tag>
                        <label class="font-light">Type</label>
                        <cat_pri class="font-medium"></cat_pri>
                    </tag>
                </flex>
                <column class="col-span-1">
                    <a href="#" class="btn btn-sm normal-case btn-neutral">
                        Documents</a>
                </column>
            </column>
        </inside>
    </corporation>
</templates>
