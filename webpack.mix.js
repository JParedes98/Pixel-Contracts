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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .browserSync({
       files: [
           'app/**/*',
           'resources/views/**/',
           'resources/lang/**/',
           'public/css/**/*',
           'public/js/**/*',
           'routes/**/*'
       ],
       notify: {
           styles: [
               "display: none",
               "padding: 15px",
               "font-family: sans-serif",
               "position: fixed",
               "font-size: 0.9em",
               "z-index: 9999",
               "bottom: 2px",
               "right: 2px",
               "border-bottom-left-radius: 5px",
               "background-color: #1B2032",
               "margin: 0",
               "color: white",
               "text-align: center",
               "border-radius: 3px"
           ]
       }
   });
