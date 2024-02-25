const mix = require('laravel-mix');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.alias({
    '@': path.join(__dirname, 'resources/frontend'),
})

mix.js('resources/frontend/App.js', 'public/js')
    .vue()
    .sass('resources/frontend/assets/styles/global.scss', 'public/css');
