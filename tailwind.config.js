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

    plugins: [forms],
};
