const colors = require("tailwindcss/colors");
const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    important: true,
    purge: [
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
                lato: ["'Lato', sans-serif"]
            }
        },
        colors: {
            transparent: "transparent",
            current: "currentColor",
            black: colors.black,
            gray: colors.coolGray,
            white: colors.white,
            red: colors.red,
            yellow: colors.amber,
            blue: colors.blue,
            pink: colors.pink,
            teal: colors.teal,
            indigo: colors.indigo
        }
    },

    variants: {
        extend: {
            opacity: ["disabled"]
        }
    },

    plugins: [require("@tailwindcss/forms"), require("@tailwindcss/typography")]
};
