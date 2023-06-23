<x-layout.dashboard :user="$user">
    @vite(['resources/js/category/category-index.js'])
    <style>
        ._row_code {
            display: none;
        }
    </style>
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
            <card class="js-card-template card w-full bg-base-100  shadow-xl relative">
                <figure class="h-64"><img src="https://api.dicebear.com/6.x/shapes/svg?seed=qgK4p36iXT" class="h-full w-full object-cover" />
                </figure>
                <badges class="card-actions justify-end absolute top-4 right-4">
                    <div class="js-badge-creator badge badge-warning">Creator</div>
                    <div class="js-badge-reciver badge badge-warning">Reciver</div>
                </badges>
                <card-body class="card-body p-4">
                    <subject class="font-medium">
                        <ref class="js-card-subject"></ref>
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
                                    <ref class="js-card-creator"></ref>
                                </span>
                            </value>
                        </creator>
                        <requester class="text-sm flex justify-between">
                            <icon class="flex items-center gap-1">
                                <x-fas-user />
                                <span>Requester: </span>
                            </icon>
                            <value>
                                <span>
                                    <ref class="js-card-requester"></ref>
                                </span>
                            </value>
                        </requester>

                        <reciver class="text-sm flex justify-between">
                            <icon class="flex items-center gap-1">
                                <x-fas-eye />
                                <span>Reciver: </span>
                            </icon>
                            <value>
                                <span>
                                    <ref class="js-card-reciver"></ref>
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
