const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
mix.styles([
    'public/assets/css/libs/blog-post.css',
    'public/assets/css/libs/bootstrap.css',
    'public/assets/css/libs/bootstrap.min.css',
    'public/assets/css/libs/font-awesome.css',
    'public/assets/css/libs/metisMenu.css',
    'public/assets/css/libs/sb-admin-2.css',
    'public/assets/css/libs/styles.css'
    
    ], 'public/css/all.css');
mix.scripts([
    'public/assets/js/libs/bootstrap.js',
    'public/assets/js/libs/bootstrap.min.js',
    'public/assets/js/libs/jquery.js',
    'public/assets/js/libs/metisMenu.js',
    'public/assets/js/libs/sb-admin-2.js',
    'public/assets/js/libs/scripts.js'
    ], 'public/js/all.js');
