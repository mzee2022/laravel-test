/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.css",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
            },
        },

        container: {
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                lg: '4rem',
                xl: '5rem',
                '2xl': '6rem',
            },
        },
        plugins: [
            require('tailwindcss-animatecss')({
                settings: {
                    animatedSpeed: 1000,
                    heartBeatSpeed: 1000,
                    hingeSpeed: 2000,
                    bounceInSpeed: 750,
                    bounceOutSpeed: 750,
                    animationDelaySpeed: 1000
                },
                variants: ['responsive'],
            }),
        ],

        screens: {
            'sm': {'max': '639px'},

            'md': {'max': '767px'},

            'lg': {'max': '1023px'},

            'xl': {'max': '1279px'},
        },
        fontFamily: {
            'sans': ['Ubuntu', 'Sans-serif']
        },

    }
}