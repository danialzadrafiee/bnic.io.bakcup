<x-layout.dashboard :user="$user">

    @vite(['resources/js/category/category-index.js'])
    <style>
        ._row_code {
            display: none;
        }
    </style>


    <BMODAL id="modal_edit"
        class="JSX_MODAL w-screen z-[100] flex items-center justify-center h-screen bg-black/70 fixed left-0 top-0"
        style="display: none">

        <inside class=" bg-white w-[500px] rounded-xl">
            <form action="{{ route('cert.category_update') }}">
                <input type="hidden" name="certificate_id" class="js_cetificate_id" value="">
                <grid class="grid grid-cols-2 gap-4 p-8">
                    <cel class="col-span-2">
                        <heading>
                            <ref class="js_cert_name text-lg font-semibold"></ref>
                        </heading>
                    </cel>
                    <cel class="col-span-1">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm">Primary Category</span>
                            <select name="category_id"
                                class="select !border !border-neutral-5/30 js_categories"></select>
                        </label>
                    </cel>
                    <cel class="col-span-1">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm">Sub Category</span>
                            <select name="sub_cat_id"
                                class="select !border !border-neutral-5/30 js_categories_sub"></select>
                        </label>
                    </cel>
                    <cel class="col-span-2  justify-self-end">
                        <button type="button" class="btn btn-error JSX_MODAL_CLOSE">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Save changes</button>
                    </cel>
                </grid>
            </form>
        </inside>

    </BMODAL>

    @include('category.index.edit')

    <main class="flex flex-col gap-2 max-w-[100%] @container ">
        <header class="flex items-center justify-between">
            <left>
                <subject class="js-category-title font-semibold text-lg">Documents</subject>
            </left>
            <right class="flex items-center gap-2">
                <button class="js_open_request_certificate_modal btn btn-neutral hover:btn-primary">Request new
                    certificate</button>
                @include('category.index.select')
            </right>
        </header>

        <divider class="divider mt-0"></divider>
        <templates class="hidden">
            <card cat-id="" sub-cat-id="" class="js-card-template card w-full bg-base-100  shadow-xl relative">
                <header class="rounded-t-lg relative">
                    <figure class="h-64"><img src="https://api.dicebear.com/6.x/shapes/svg?seed=qgK4p36iXT"
                            class="h-full w-full object-cover" />
                        <edit_card
                            class="js_edit_card cursor-pointer flex bg-neutral top-4 left-4 rounded-lg text-white items-center absolute justify-center w-8 h-8">
                            <x-fas-edit></x-fas-edit>
                        </edit_card>
                    </figure>
                    <badges class="card-actions justify-end absolute bottom-4 right-4">
                        <div class="js-badge-creator badge badge-warning">Creator</div>
                        <div class="js-badge-reciver badge badge-warning">Reciver</div>
                    </badges>
                </header>
                <card-body class="card-body relative p-4">

                    <subject class="font-medium flex justify-between items-center">
                        <ref class="js-card-subject"></ref>
                        <div class="flex items-center justify-center  text-sm divide-x">
                            <ref class="js_card_cat   pr-1"></ref>
                            <ref class="js_card_sub_cat  pl-1"></ref>
                        </div>
                    </subject>
                    <description class="text-sm">
                        <ref class="js-card-description"></ref>
                    </description>

                    <flex class="flex items-center gap-4 text-neutral">
                        <date class="text-sm flex gap-1 items-center">
                            <x-far-calendar />
                            <span class="mt-0.5">
                                <ref class="js-card-date"></ref>
                            </span>
                        </date>
                        <clock class="text-sm flex gap-1 items-center">
                            <x-far-clock />
                            <span class="mt-0.5">
                                <ref class="js-card-time"></ref>
                            </span>
                        </clock>
                    </flex>
                    <metadata class="py-2 flex flex-col gap-1">
                        <creator class="text-sm flex justify-between">
                            <icon class="flex items-center gap-1">
                                <x-fas-right-from-bracket />
                                <span>Creator: </span>
                            </icon>
                            <value>
                                <span>
                                    <ref class="js-card-creator capitalize"></ref>
                                </span>
                            </value>
                        </creator>
                        <requester class="text-sm flex justify-between">
                            <icon class="flex items-center gap-1">
                                <x-fas-user />
                                <span class="">Requester: </span>
                            </icon>
                            <value>
                                <span>
                                    <ref class="js-card-requester capitalize"></ref>
                                </span>
                            </value>
                        </requester>

                        <reciver class="js-requester-row  text-sm flex justify-between">
                            <icon class="flex items-center gap-1">
                                <x-fas-eye />
                                <span>Reciver: </span>
                            </icon>
                            <value>
                                <span>
                                    <ref class="js-card-reciver capitalize"></ref>
                                </span>
                            </value>
                        </reciver>
                    </metadata>
                    <actions>
                        <a href="#" class="js-card-action btn btn-neutral hover:btn-primary w-full ">Watch
                            certificate</a>
                    </actions>
                </card-body>
            </card>
        </templates>
        <documents class="js-certificate-requests grid grid-cols-2 @[800px]:grid-cols-3  gap-4">
        </documents>


    </main>

</x-layout.dashboard>
