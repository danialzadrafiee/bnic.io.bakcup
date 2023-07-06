@vite(['resources/js/category/category-select.js'])


<flex class="flex gap-4 items-center ">
    <field>
        <select class="js-category-select select border border-neutral-5/30 w-full max-w-xs">
            <option value="0">All</option>
        </select>
    </field>
    <field class="js_sub_cat_filter_field" style="display: none">
        <div class="dropdown">
            <label tabindex="0"
                class="input border border-neutral-5/30 flex gap-2 cursor-pointer hover:bg-neutral hover:text-white transition-all items-center justify-center m-1">Filters
                <x-fas-filter></x-fas-filter>
            </label>
            <ul tabindex="0"
                class="dropdown-content z-[1] menu p-2 right-0 left-auto shadow bg-base-100 rounded-box w-52">
                <li class="js-sub-cat-list">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="checkbox checkbox-xs rounded">
                        <div>Other</div>
                    </label>
                </li>
            </ul>
        </div>
    </field>
    <settings class="js-category-setting flex items-center gap-2 cursor-pointer" style="display: none">
        <x-fas-gear></x-fas-gear> Edit
    </settings>
</flex>
