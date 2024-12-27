import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            screens: {
                xsm: "425px",
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                xxs: "0.5rem",
            },
            colors: {
                red: {
                    1000: "#CC0000",
                },
                green: {
                    1000: "#00CC00",
                },
                blue: {
                    1000: "#0000CC",
                },
                customgray: {
                    100: "#eeeeee",
                    200: "#f0f0f0",
                    300: "#666666",
                },
            },
        },
    },

    plugins: [
        forms,
        function ({ addComponents, theme }) {
            addComponents({
                ".mobi-polygon": {
                    clipPath: "polygon(0 50%, 100% 0, 100% 100%, 0% 100%)",
                },
                ".desktop-polygon": {
                    clipPath: "polygon(55% 0, 100% 0, 100% 100%, 0 100%)",
                },
                ".mobi-container": {
                    margin: "20px",
                },
                ".desktop-container": {
                    margin: "0",
                    width: "140%",
                    position: "absolute",
                    top: "50%",
                    left: "85%",
                    transform: "translate(-50%, -50%)",
                },
            });
        },
        {},
    ],
};
