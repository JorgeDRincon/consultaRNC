import forms from "@tailwindcss/forms";
import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            animation: {
                "gradient-x": "gradient-x 3s ease-in-out infinite",
            },
            keyframes: {
                "gradient-x": {
                    "0%": {
                        "background-size": "300% 100%",
                        "background-position": "75% 50%",
                    },
                    "33%": {
                        "background-size": "300% 100%",
                        "background-position": "100% 50%",
                    },
                    "66%": {
                        "background-size": "300% 100%",
                        "background-position": "0% 50%",
                    },
                    "100%": {
                        "background-size": "300% 100%",
                        "background-position": "75% 50%",
                    },
                },
            },
        },
    },

    plugins: [forms],
};
