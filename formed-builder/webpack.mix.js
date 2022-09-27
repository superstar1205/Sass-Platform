const path = require('path')

const tailwindcss = require('tailwindcss');

const mix = require('laravel-mix');

mix.setPublicPath('../public')

mix.alias({
    '~': path.resolve(__dirname, './'),
    '@': path.resolve(__dirname, 'src')
})

mix.js(__dirname + '/src/main.jsx', 'js/formed-builder.js').react()
    .postCss( __dirname + '/src/index.css','css/formed-builder.css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })



