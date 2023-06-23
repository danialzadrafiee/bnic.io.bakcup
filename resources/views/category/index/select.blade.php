@vite(['resources/js/category/category-select.js'])


<flex class="flex gap-4 items-center ">
    <field>
        <select class="js-category-select select select-bordered w-full max-w-xs">
            <option value="0">All</option>
        </select>
    </field>
    <settings class="js-category-setting flex items-center gap-2 cursor-pointer" style="display: none">
        <x-fas-gear></x-fas-gear> Edit
    </settings>

</flex>
