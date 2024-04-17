import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                'coffee-brown': '#4a2c1d',
                'caramel': '#b1733f',
                'cream': '#f8f4eb',
                'espresso': '#2b1b17',
                'latte': '#d5b59f',
                'latte-700': '#d5b589',
                'red': '#a43f37',
                'crimson': '#96031A',
                'green': '#678963',
                'dark': '#111110',
            },
            fontFamily: {
                'archivo': ['Archivo Narrow', ...defaultTheme.fontFamily.sans],
            },
            borderColor: theme => ({
                ...theme('colors'),
            }),
            ringColor: theme => ({
                ...theme('colors'),
            }),
            fontSize: {
                '3rem': '3rem',
                '4rem': '4rem',
                '5rem': '5rem',
            },
        },
    },

    plugins: [forms, typography],
};
