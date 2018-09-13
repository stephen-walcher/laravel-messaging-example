let mix = require('laravel-mix');

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

mix.autoload({
    jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery"]
   })
   .js('resources/assets/js/admin.js', 'public/js')
   .js('resources/assets/js/client.js', 'public/js')
   .extract(["vue", "bootstrap", "bootstrap-datepicker", "@fortawesome/fontawesome-free", "axios", "jquery", "lodash", "pusher-js", "popper.js", "laravel-echo"])
   .sass('resources/assets/sass/app.scss', 'public/css');
