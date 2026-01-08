import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'false',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Manrope', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                float: 'float 4s ease-in-out infinite',
            },
            keyframes: {
                float: {
                    '0%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-20px)' },
                    '100%': { transform: 'translateY(0)' },
                },
            },
        },
    },

    plugins: [forms],
};
