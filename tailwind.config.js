import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */



export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            colors: {
        beige: {
          50: '#fdfaf4',
          100: '#f9f1e3',
          200: '#f3e4cd',
          300: '#e6cfaa',
          400: '#d5b78b',
          500: '#be9762',
          600: '#a37c48',
          700: '#82603b',
          800: '#6c4f34',
          900: '#5b432e',
        },
      },
        },
    },



    plugins: [forms],
};
