@vite(['resources/js/category-edit.js'])

<templates class="hidden">
    <card data-cert-id="0" data-category-id="0" data-active='0'
        class="js-category-card-template js-category-card card w-full shadow-sm  cursor-pointer ">
        <inside class="card-body py-4 flex justify-between items-center flex-row">
            <left class="flex items-center gap-4 ">
                <subject ref="cert-name" class="font-semibold pr-4 border-r">Driver licence</subject>
                <description ref="cert-description text-xs">Random description for default form
                </description>
            </left>
            <email ref="cert-creator-name" class="flex gap-1 items-center justify-center ">
                <x-fas-layer-group></x-fas-layer-group>Microsoft
            </email>
        </inside>
    </card>
</templates>



<dialog id="editCategoryModal" class="modal">
    <form method="dialog" class="modal-box w-11/12 max-w-5xl p-0 ">
        <header class="p-6 flex w-full items-center justify-between">
            <h3 class="text-lg font-semibold  ">
                Category Settings
            </h3>
            <publicity>
                <div class="form-control">
                    <label class="label cursor-pointer gap-4 flex ">
                        <span class="label-text">Privite</span>
                        <input type="checkbox" class="toggle toggle-primary" />
                    </label>
                </div>
            </publicity>
        </header>
        <modal-body class="js-modal-cateogry-select bg-base-200 flex flex-col gap-2 p-6">
        </modal-body>
        <footer class="p-6 flex gap-2 items-center justify-items-end justify-end w-full">
            <delete data-category-id="0" class="js-modal-delete-category btn btn-error">Delete this category</delete>
            <save class="js-modal-save flex w-max  btn btn-primary">Save</save>
        </footer>
    </form>

</dialog>
