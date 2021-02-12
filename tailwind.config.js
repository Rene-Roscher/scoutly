const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    darkMode: 'media',
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                code: {
                    green: '#b5f4a5',
                    yellow: '#ffe484',
                    purple: '#d9a9ff',
                    red: '#ff8383',
                    blue: '#93ddfd',
                    white: '#fff',
                },
                'primary': {
                    DEFAULT: '#554E9C',
                    '50': '#E1E0F0',
                    '100': '#D1CFE7',
                    '200': '#B1ADD6',
                    '300': '#908BC5',
                    '400': '#7069B4',
                    '500': '#554E9C',
                    '600': '#423D7A',
                    '700': '#302C58',
                    '800': '#1D1B36',
                    '900': '#0B0A14'
                },
                // primary: '#554e9c',
                // "primary-low": '#7b74ba',
            },
        },
    },

    variants: {
        extend: {
            // opacity: ['disabled'],
            textOpacity: ['dark']
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
