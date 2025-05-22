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
                "primary1": "#D8E6F4",     // Soft Frost Blue
                "secondary1": "#6E8BB0",   // Dusty Denim Blue
                "tertiary1": "#092B55",    // Deep Navy (pengganti 550909 vibe-nya)
                "primary2": "#7CB0DE",     // Skywashed Blue
                "secondary2": "#2B5FCC",   // Bold Blue (strong tapi gak neon)
                "tertiary2": "#1748AF",    // Royal Indigo
                "tertiary3": "#093074",    // Dark Cobalt
                "tertiary4": "#061A37",    // Midnight Blue (gelap banget, buat background/depth)
                "backgroundblue": "#F2F6FD", // Soft Frost White
            }
        },
    },

    plugins: [forms],
};
