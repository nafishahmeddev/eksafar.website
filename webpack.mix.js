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

//  mix.js('resources/js/app.js', 'public/js')
//  .react()
//  .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/admin/admin.js', 'public/js/admin')
   .react()
   .sass('resources/sass/admin/admin.scss', 'public/css/admin');

mix.js('resources/js/front/app.js', 'public/js/front')
   .react()
   .sass('resources/sass/front/dark/app.scss', 'public/css/front/dark')
   .sass('resources/sass/front/light/app.scss', 'public/css/front/light');
