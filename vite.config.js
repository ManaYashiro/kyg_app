import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/beta.css",
                "resources/js/app.js",

                // custom
                "resources/js/modules/base.js",
                "resources/js/modules/datepicker.js",

                // images
                "resources/img/main/favicon.ico",
                "resources/img/main/logo.png",
            ],
            refresh: true,
        }),
    ],
});
