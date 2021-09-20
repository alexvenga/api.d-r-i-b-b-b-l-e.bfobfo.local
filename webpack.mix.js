const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .setPublicPath('public/assets')
    .setResourceRoot('/assets/')

    .js('resources/js/app.js', 'js')

    //.js('resources/js/axios.js', 'js')


    .postCss('resources/css/app.css', 'css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('postcss-nested'),
        require('autoprefixer'),
    ])

    //.copy(
    //    'resources/img/*', 'public/assets/img',
    //)

    //.copy(
    //    'resources/css/typography.min.css', 'public/assets/css/typography.min.css',
    //);

    //.copy('resources/fonts/*', 'public/assets/fonts');
    .version();
