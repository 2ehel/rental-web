const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        mytheme: {
            "primary": "#a3e635",
            "secondary": "#baa4f9",
            "accent": "#a3e635",
            "neutral": "#F7F7F7",
            "base-100": "#F9FAFB",
            "info": "#3756E1",
            "success": "#5BE6D6",
            "warning": "#F8B062",
            "error": "#F25486",
        },
        
    },

    plugins: [require('@tailwindcss/forms')],

    plugins: [require("daisyui")],
};
