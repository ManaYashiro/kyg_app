import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/beta.css",
                "resources/css/hamburger.css",
                "resources/js/app.js",

                // custom
                "resources/css/modules/calender.css",

                "resources/js/modules/ajaxConfirm.js",
                "resources/js/modules/base.js",
                "resources/js/modules/datepicker.js",
                "resources/js/modules/page-navi-buttons.js",
                "resources/js/modules/calender.js",
                "resources/js/modules/dashboard.js",
                // auth
                "resources/css/modules/auth/mypage.css",
                "resources/js/modules/auth/register.js",

                // images
                "resources/img/main/favicon.ico",
                "resources/img/main/logo.png",
                "resources/img/main/kimura_footer.png",
                "resources/img/main/pagetop.gif",
            ],
            refresh: true,
        }),
    ],
});
