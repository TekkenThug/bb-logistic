import { defineConfig } from "vite";

import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/frontend/App.js"],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            "@": "/resources/frontend",
        },
        extensions: ['.vue', '.js', '.ts', '.tsx', '.jsx'],
    },
})