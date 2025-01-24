import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/fonts/font-awesome/css/all.min.css",
                "resources/css/reset.css",
                "resources/css/main.css",
                "resources/js/header.js",
                "resources/js/main-slider.js",
            ],
            refresh: true,
        }),
    ],
});
