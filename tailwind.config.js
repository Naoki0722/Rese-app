const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        screens: {
            'xl': { 'max': '1279px' },
            'lg': { 'max': '1023px' },
            'md': { 'max': '768px' },
            'sm': {'max': '639px'},
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],

    corePlugins: {
        outline: false,
    },

    variants: {
        backgroundColor: ['responsive', 'hover' ,'focus'],
    }
};
