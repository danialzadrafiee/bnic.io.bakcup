import { defineConfig } from "vite"
import laravel from "laravel-vite-plugin"
import { Buffer } from "buffer"
import { NodeGlobalsPolyfillPlugin } from "@esbuild-plugins/node-globals-polyfill"

// Define 'global' for packages

export default defineConfig({
    assetsInclude: ["**/*.html"],
    plugins: [
        laravel({
            input: [
                "resources/css/app.scss",
                "resources/css/corporation-create.scss",
                "resources/css/corporation-show.scss",
                "resources/css/dashboard-index.scss",
                "resources/css/document-create.scss",
                "resources/css/override.scss",
                "resources/css/profile-index.scss",
                "resources/css/x-aside.scss",
                "resources/js/abi.js",
                "resources/js/app.js",
                "resources/js/auth-index.js",
                "resources/js/auth-register-corp.js",
                "resources/js/auth-register.js",
                "resources/js/category/category-edit.js",
                "resources/js/category/category-index.js",
                "resources/js/category/category-select.js",
                "resources/js/cert-show.js",
                "resources/js/corporation-create.js",
                "resources/js/createnft.js",
                "resources/js/dashboard-index.js",
                "resources/js/dashboard-layout.js",
                "resources/js/document-create.js",
                "resources/js/document-create.min.js",
                "resources/js/document-show.js",
                "resources/js/event-create.js",
                "resources/js/event-show.js",
                "resources/js/footer.js",
                "resources/js/inbox.js",
                "resources/js/invidual-dashboard.js",
                "resources/js/invidual-signchain.js",
                "resources/js/modal_publicity_edit.js",
                "resources/js/nft.bak.js",
                "resources/js/nft.js",
                "resources/js/qrcode.js",
                "resources/js/vite-shims.js",
                "resources/js/x-aside.js",
            ],

            refresh: true,
        }),
    ],
    optimizeDeps: {
        esbuildOptions: {
            // Node.js global to browser globalThis
            define: {
                global: "globalThis",
            },
            // Enable esbuild polyfill plugins
            plugins: [
                NodeGlobalsPolyfillPlugin({
                    buffer: true,
                }),
            ],
        },
    },
})

//
