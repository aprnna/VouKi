import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    prefix: "tw-",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        // "./vendor/mkocansey/bladewind/resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            screens: {
                sm: "640px", // Default
                md: "768px",
                lg: "1024px",
                xl: "1280px",
            },
            colors:{
                "primary1": "#F4D8D8",
                "secondary1": "#B06E6E",
                "tertiary1": "#550909",
                "primary2": "#DE7C7D",
                "secondary2": "#CC2B52",
                "tertiary2": "#AF1740",
                "tertiary3": "#740938",
                "tertiary4": "#37061B",
            }
        },
    },

    plugins: [forms],
};
