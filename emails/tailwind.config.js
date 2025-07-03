import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
module.exports = {
  presets: [
    require('tailwindcss-preset-email'),
  ],
  content: [
    './components/**/*.html',
    './emails/**/*.html',
    './layouts/**/*.html',
  ],
  theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                kanit: ['Kanit', 'sans'],
                caramel: ['caramel', 'cursive'],
            },
            colors:{
                'rclaro': '#CC0428',
                'roscuro': '#9A031E',
                'negro': '#0A100D',
                'blanco': '#FEF9EF',
            },
        },
    },
}
