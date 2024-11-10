import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                kanit: ['Kanit', 'sans'],
                caramel: ['Caramel', 'cursive'],
            },
            colors:{
                'rclaro': '#CC0428',
                'roscuro': '#9A031E',
                'negro': '#0A100D',
                'blanco': '#FEF9EF',

            },
        },
    },
    plugins: [],
};
