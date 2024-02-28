import { defineConfig } from "vite";

import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/frontend/main.js"],
            refresh: true,
        }),
        vue(),
    ],

    css: {
        preprocessorOptions: {
            scss: {
                additionalData: "@use './resources/frontend/assets/styles/exported' as *;",
            },
        },
    },

    resolve: {
        alias: {
            "@": "/resources/frontend",
        },
        extensions: ['.vue', '.js', '.ts', '.tsx', '.jsx'],
    },

    define: {
        '__APP_VERSION__': JSON.stringify(process.env.npm_package_version),
    }
})