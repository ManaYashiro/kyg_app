import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/top.css",
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
                // - css
                "resources/css/modules/auth/mypage.css",
                // - js
                "resources/js/modules/auth/register.js",

                // images
                // - main
                "resources/img/main/favicon.ico",
                "resources/img/main/logo.png",
                "resources/img/main/kimura_footer.png",
                "resources/img/main/pagetop.gif",

                // - top
                "resources/img/top/warning.png",
                "resources/img/top/check.png",
                "resources/img/top/maintenance.png",
                "resources/img/top/vmaintenance.png",
                "resources/img/top/estimate.png",
                "resources/img/top/top.png",
                "resources/img/top/top2.png",
                "resources/img/top/scroll.png",
                "resources/img/top/inazawa.jpg",
                "resources/img/top/nagoyakita.jpg",
            ],
            refresh: true,
        }),
    ],
});
