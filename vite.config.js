import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    define: {
        "process.env": process.env,
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/top.css",
                "resources/css/beta.css",
                "resources/css/hamburger.css",
                "resources/js/app.js",

                // custom
                "resources/css/modules/calendar.css",

                "resources/js/modules/base.js",
                "resources/js/modules/calendar.js",
                "resources/js/modules/dashboard.js",
                "resources/js/modules/datepicker.js",
                "resources/js/modules/keyboard.js",
                "resources/js/modules/page-navi-buttons.js",
                "resources/js/modules/registerConfirm.js",

                // admin
                "resources/js/modules/admin/navi.js",

                // auth
                // - css
                "resources/css/modules/auth/mypage.css",
                // - js
                "resources/js/modules/auth/register.js",

                // profile
                "resources/css/modules/profile.css",

                // appointments
                "resources/js/modules/appointments/index.js",
                "resources/js/modules/appointments/admin-form.js",

                // images
                // - main
                "resources/img/main/favicon.ico",
                "resources/img/main/logo.png",
                "resources/img/main/kimura_footer.png",
                "resources/img/main/pagetop.gif",

                // - top
                "resources/img/top/warning.png",
                "resources/img/top/learn_more.png",
                "resources/img/top/check.png",
                "resources/img/top/button_check.png",
                "resources/img/top/active_inspection.png",
                "resources/img/top/inactive_inspection.png",
                "resources/img/top/active_maintenance.png",
                "resources/img/top/inactive_maintenance.png",
                "resources/img/top/active_estimate.png",
                "resources/img/top/inactive_estimate.png",
                "resources/img/top/top.png",
                "resources/img/top/top2.png", // TODO delete
                "resources/img/top/scroll.png",
                "resources/img/top/inazawa.jpg",
                "resources/img/top/nagoyakita.jpg",
                "resources/img/top/kariya.jpg",
                "resources/img/top/nishiki.jpg",
                "resources/img/top/toyota.jpg",
                "resources/img/top/imuyama.jpg",
                // - top calendar
                "resources/img/modules/calendar/calendar-none.gif",

                // 予約確認
                "resources/css/modules/reservation/confirmationitems.css",
                "resources/js/modules/reservation/confirmationitems.js",
                "resources/js/modules/reservation/api/reservation.js",
            ],
            refresh: true,
        }),
    ],
});
